<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $totalUsers = User::count(); 
        $totalProjects = Project::count(); 
        $totalCompletedProjects = Project::where('status_id', 'COMPLETED')->count();
        return view('home', ['totalUsers' => $totalUsers,'totalCompletedProjects' => $totalCompletedProjects,'totalProjects' => $totalProjects]); // تمرير العدد إلى عرض الصفحة الرئيسية
    }

    public function show() {
        $projectsInProgress = Project::where('status_id', 'IN_PROGRESS')->get();



        $totalUsers = User::count(); 
         $totalProjects = Project::with('tasks')->get(); 
        // $totalProjects = Project::count(); 
        $totalCompletedProjects = Project::where('status_id', 'COMPLETED')->count();
        return view('projectdetails', compact('totalUsers','totalCompletedProjects','totalProjects')); // تمرير العدد إلى عرض الصفحة الرئيسية
    }
}
