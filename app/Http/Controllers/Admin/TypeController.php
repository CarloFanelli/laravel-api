<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {

        //dd($request);
        $val_data = $request->validated();

        $val_data['slug'] = Type::generateSlug($val_data['name']);

        Type::create($val_data);

        return to_route('admin.types.index')->with('message', 'new type added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $projects = Project::where('type_id', '=', $type->id)->get();

        return view('admin.types.show', compact('type', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {


        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        if ($request->has('name')) {
            $val_data['name'] = $request->name;
        }

        $type->update($val_data);

        return to_route('admin.types.index')->with('message', 'update with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->forceDelete();

        return to_route('admin.types.index');
    }
}
