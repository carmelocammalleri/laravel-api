<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('type')->paginate(10);
        return response()->json($projects);
    }

    public function getProjectBySlug($slug){
        $project = Project::where('slug', $slug)->first();
        return response()->json($project);
    }
}
