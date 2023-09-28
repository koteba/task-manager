<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
        if ($request->query('search_projects') !== null) {
            $search = $request->query('search_projects');

            $projects= Project::where('name','LIKE', "%{$search}%")->paginate(3);

        } 
        elseif ($request->query('to_date') !== null) {
            $to_date = $request->input('to_date');
            $from_date = $request->input('from_date');
            $projects = Project::where('start_date', '>' ,$from_date)->where('start_date', '<', $to_date)
            ->orwhere('end_date', '>',$from_date)->where('end_date', '<' , $to_date)->paginate(3);        }
        
        else{
            $projects = Project::latest()->paginate(3);

        }
		return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $project = new Project;
		return view('project.create', compact('project','users','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $request->name . '.' . $file->extension();
            $file->storeAs('public/projectss', $filename);
            $data['image'] = $filename;
        }
    
        $project = Project::create($data);


        if (isset($data['user_ids']) && is_array($data['user_ids'])) {
            foreach ($data['user_ids'] as $userId) {
                $assignment = new ProjectAssignment([
                    'user_id' => $userId,
                    'project_id' => $project->id
                ]);
    
                $assignment->save();
            }}
            return redirect()->route('projects.index')->withSuccess('Data successfully created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        $users = User::all();
        $totals = $project->projectassignment()->where('project_id', $project->id)->get();
        return view('project.edit', compact('users','project','totals','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file= $request->file('image');
            Storage::delete('public/projects/' . $file);
            // $file = $request->file('image');
            $filename = $request->name . '.' . $file->extension();
            $file->storeAs('public/projectss', $filename);
                $data['image']= $filename;
            // $fileName= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('students'), $fileName);
          
        }else{
            $filename=$project->image;
        }

 
        $project->status_id = $request->input('status_id');
     
        
        $project->update($data);
        if (isset($data['user_ids']) && is_array($data['user_ids'])) {
            ProjectAssignment::where('project_id', $project->id)->delete();

            foreach ($data['user_ids'] as $userId) {
                $assignment = new ProjectAssignment([
                    'user_id' => $userId,
                    'project_id' => $project->id
                ]);
    
                $assignment->save();
            }}
        

            return redirect()->route('projects.index')->withSuccess('Data successfully updated.');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->tasks()->count() > 0) {
            return redirect()->route('projects.index')->withError('The project cannot be deleted because it contains an important task.');
        }
  
    
        $project->delete();
        if ($project->projectassignment()->count() > 0) {
            $project->projectassignment()->delete();
        }
    

    
        return redirect()->route('projects.index')->withError('The data has been deleted successfully.');
    }


    public function archive(){
        $archivedProjects = Project::onlyTrashed()->paginate(3);
        return view('project.archive',compact('archivedProjects'));
    }
    public function trash($id)
    {
        try {
           
            $project = Project::withTrashed()->find($id);
            if (Storage::exists('public/projectss/' . $project->image)) {
                Storage::delete('public/projectss/' . $project->image);
            }
            $assignments = ProjectAssignment::where('project_id', $project->id)->withTrashed()->get();
            
            foreach ($assignments as $assignment) {
                $assignment->restore();
            }
            
            if ($project) {
                $project->forceDelete();
                return redirect()->back()->with('success', 'The record has been successfully deleted permanently');
            } else {
                return redirect()->back()->with('error', 'Not found in the table');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'An error occurred while deleting the recording');
        }
    }
    

    public function restore($id)
    {
        try {
            $project = Project::withTrashed()->find($id);
            
            if ($project) {
                $project->restore();
                $assignments = ProjectAssignment::where('project_id', $project->id)->withTrashed()->get();
            
                foreach ($assignments as $assignment) {
                    $assignment->restore();
                }
                return redirect()->back()->with('success', 'The record has been restored successfully');
            } else {
                return redirect()->back()->with('error', 'Not found in the table');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'An error occurred while restore the record');
        }
    }

   
    
}
