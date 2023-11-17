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
            'projects' => Project::with(['technologies', 'type'])->paginate(7),
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
}
