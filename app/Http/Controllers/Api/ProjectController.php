<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projectsApi()
    {

        return response()->json([
            'projects' => Project::with(['technologies', 'type'])->orderByDesc('id')->paginate(6),
        ]);
    }

    public function typesApi()
    {

        return response()->json([
            'projects' => Type::with('projects')->get(),
        ]);
    }

    public function technologiesApi()
    {

        return response()->json([
            'projects' => Technology::with('projects')->get(),
        ]);
    }

    public function singleProject($slug)
    {

        $single_project = Project::with(['technologies', 'type'])->where('slug', $slug)->first();

        if ($single_project) {
            return response()->json([
                'response' => true,
                'single_project' => $single_project,
            ]);
        } else {
            return response()->json([
                'response' => false,
                'single_project' => 'project not found!',
            ]);
        };
    }
}
