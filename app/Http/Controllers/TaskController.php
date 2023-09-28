<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Enums\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    
    {
        if ($request->query('search_tasks') !== null) {
            $search = $request->query('search_tasks');

            $tasks= Task::where('name','LIKE', "%{$search}%")->paginate(3);

        } 
        elseif ($request->query('to_date') !== null) {
            $to_date = $request->input('to_date');
            $from_date = $request->input('from_date');
            $tasks = Task::where('start_date', '>' ,$from_date)->where('start_date', '<', $to_date)
            ->orwhere('end_date', '>',$from_date)->where('end_date', '<' , $to_date)->paginate(3);
        }
        
        else{
            $tasks = Task::latest()->paginate(3);


        }

		return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
         $users = User::all();
        $totals=DB::table('project_assignments')
         ->join('projects','project_assignments.project_id','=','projects.id')
         ->join('users','project_assignments.user_id','=','users.id')->where('project_id', $project->id)
         ->get();
        
		return view('task.create', compact('project','users','totals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request,Project $project)
    {
        $data = $request->validated();

   
        $task = Task::create($data);
        
        if (isset($data['user_ids']) && is_array($data['user_ids'])) {
            foreach ($data['user_ids'] as $userId) {
                $assignment = new TaskAssignment([
                    'user_id' => $userId,
                    'task_id' => $task->id
                ]);
    
                $assignment->save();
            }
        }
        if ($request->has('save_and_add_new')) {
            return redirect()->back()->withSuccess('Data successfully created.');

        }
        else{
        
        return redirect()->route('all.show', ['project' => $task->project->id])->withSuccess('Data successfully created.');
    }}
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($project)
    {
        $tasks=Task::where('project_id',$project)->paginate(3);
        return view('task.show')->with('tasks',$tasks);
        // return$tasks=Task::find($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project,Task $task)
    {
       
        $users = User::all();
        $projects = Project::all();
        $project= Project::find($task->project_id);
$allusersproject = $project->projectassignment;
 $alluserstasks = $task->taskassignment;
foreach($allusersproject as $dd)
 $dd->user->name;


        return view('task.edit', compact('task','users','projects','allusersproject','alluserstasks'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
        public function update(TaskRequest $request, Task $task)
        {
            $data = $request->validated();
            
   
            $task->status_id = $request->input('status_id');
            
            $task->update($data);
            if (isset($data['user_ids']) && is_array($data['user_ids'])) {

                 TaskAssignment::where('task_id', $task->id)->delete();
                    foreach ($data['user_ids'] as $userId) {
                        $assignment = new TaskAssignment([
                            'user_id' => $userId,
                            'task_id' => $task->id
                        ]);
            
                        $assignment->save();
                    }

                }

  
        
            return redirect()->route('all.show', ['project' => $task->project->id])->withSuccess('Data successfully updated.');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task,TaskRequest $request)
    {

        $task->taskassignment()->delete();
        $task->delete();
		return redirect()->route('tasks.index')->withError('Data successfully deleted.');
    }


}
