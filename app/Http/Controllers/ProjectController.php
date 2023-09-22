<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $projects = Project::latest()->paginate(3);
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
        
        // Create the project
        $project = Project::create($data);
        
        // Save the selected users for the project
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // التحقق من وجود مهام مرتبطة بالمشروع
        if ($project->tasks()->count() > 0) {
            return redirect()->route('projects.index')->withError('The project cannot be deleted because it contains an important task.');
        }
    
        // حذف تعيينات المشروع
        $project->projectassignment()->delete();
    
        // حذف المشروع
        $project->delete();
    
        return redirect()->route('projects.index')->withSuccess('تم حذف البيانات بنجاح.');
    }
    
}
