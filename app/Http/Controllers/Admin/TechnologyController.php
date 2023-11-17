<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Project;
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Technology::generateSlug($val_data['name']);

        Technology::create($val_data);

        return to_route('admin.technologies.index')->with('message', 'technology added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {

        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {

        if ($request->has('name')) {
            $val_data['name'] = $request->name;
        }

        $technology->update($val_data);

        return to_route('admin.technologies.index')->with('message', 'technology updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {

        $technology->projects()->detach();

        $technology->forceDelete();

        return to_route('admin.technologies.index');
    }
}
