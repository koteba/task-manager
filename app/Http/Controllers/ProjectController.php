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

            $projects= Project::where('name','LIKE', $search)->paginate(3);

        } 
        elseif ($request->query('to_date') !== null) {
            $to_date = $request->input('to_date');
            $from_date = $request->input('from_date');
            $prjects = Project::where('');
        }
        
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


        // Create the project
        
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
            // حذف الصورة القديمة إذا كانت موجودة
            if (Storage::exists('public/projectss/' . $project->image)) {
                Storage::delete('public/projectss/' . $project->image);
            }
        
            $file = $request->file('image');
            $filename = $request->name . '.' . $file->extension();
            $file->storeAs('public/projectss', $filename);
            $data['image']= $filename;
        }
        $project->status_id = $request->input('status_id');
     
        
        $project->update($data);
        
if (isset($data['user_ids']) && is_array($data['user_ids'])) {
    foreach ($data['user_ids'] as $userId) {
        $assignment = ProjectAssignment::where('project_id', $project->id)
            ->where('user_id', $userId)
            ->first();

        if ($assignment) {
            $assignment->user_id = $userId;
            $assignment->project_id = $project->id;
            $assignment->save();
        } else {
            $newAssignment = new ProjectAssignment([
                'user_id' => $userId,
                'project_id' => $project->id
            ]);

            $newAssignment->save();
        }
    }
}
    
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
    

    
        return redirect()->route('projects.index')->withSuccess('تم حذف البيانات بنجاح.');
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
                return redirect()->back()->with('success', 'تم حذف السجل نهائيًا بنجاح');
            } else {
                return redirect()->back()->with('error', 'لم يتم العثور على السجل');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف السجل نهائيًا');
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
                return redirect()->back()->with('success', 'تم استعادة السجل بنجاح');
            } else {
                return redirect()->back()->with('error', 'لم يتم العثور على السجل');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء استعادة السجل');
        }
    }

   
    
}
