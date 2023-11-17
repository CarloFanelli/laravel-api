<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $projects_counter = Project::count();


        //return view('admin.projects.index', compact('projects'));
        return view('admin.dashboard', compact('projects_counter'));
    }
}
