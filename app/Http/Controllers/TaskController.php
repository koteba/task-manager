<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Enums\Status;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        // $statuses = Status::all();

        $tasks = Task::latest()->paginate(3);
		return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        // $statuses = Status::all();
        $task = new Task;
		return view('task.create', compact('task','users','projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        
        // Create the task
        $task = Task::create($data);
        
        // Save the selected users for the task
        if (isset($data['user_ids']) && is_array($data['user_ids'])) {
            foreach ($data['user_ids'] as $userId) {
                $assignment = new TaskAssignment([
                    'user_id' => $userId,
                    'task_id' => $task->id
                ]);
    
                $assignment->save();
            }
        }
        
        return redirect()->route('tasks.index')->withSuccess('Data successfully created.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::all();
        $projects = Project::all();
        return view('task.edit', compact('task','users','projects'));
        
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
            // if (!in_array($data['status_id'], ['PENDING', 'IN_PROGRESS', 'APPROVED', 'REJECTED'])) {
            //     return redirect()->back()->withError('Invalid status_id value.');
            // }
            // dd($data);
            $task->status_id = $request->input('status_id');

            $task->update($data);
    if (isset($data['user_ids']) && is_array($data['user_ids'])) {
        foreach ($data['user_ids'] as $userId) {
            $assignment = TaskAssignment::where('task_id', $task->id)
                ->where('user_id', $userId)
                ->first();

            if ($assignment) {
                $assignment->user_id = $userId;
                $assignment->task_id = $task->id;
                $assignment->save();
            } else {
                $newAssignment = new TaskAssignment([
                    'user_id' => $userId,
                    'task_id' => $task->id
                ]);

                $newAssignment->save();
            }
        }
    }
        
            return redirect()->route('tasks.index')->withSuccess('Data successfully updated.');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->taskassignment()->delete();
        $task->delete();
		return redirect()->route('tasks.index')->withSuccess('Data successfully deleted.');
       
    }


}
