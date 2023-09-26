<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class HomeController extends Controller
{
    public function index() {
        $totalUsers = User::count(); // احتساب عدد المستخدمين
        $totalProjects = Project::count(); // احتساب عدد المستخدمين
        $totalCompletedProjects = Project::where('status_id', 'COMPLETED')->count();
        return view('home', ['totalUsers' => $totalUsers,'totalCompletedProjects' => $totalCompletedProjects,'totalProjects' => $totalProjects]); // تمرير العدد إلى عرض الصفحة الرئيسية
    }

    public function show() {
        $totalProjects = Project::all();
        $totalUsers = User::count(); // احتساب عدد المستخدمين
        // $totalProjects = Project::count(); // احتساب عدد المستخدمين
        $totalCompletedProjects = Project::where('status_id', 'COMPLETED')->count();
        return view('projectdetails', compact('totalUsers','totalCompletedProjects','totalProjects')); // تمرير العدد إلى عرض الصفحة الرئيسية
    }
}
