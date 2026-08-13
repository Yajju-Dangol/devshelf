<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $resources = Resource::filter($request->only(['search', 'category']))
            ->latest()
            ->paginate(12);

        return view('resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\StoreResourceRequest $request)
    {
        $validated = $request->validated();
        
        if (isset($validated['tags']) && is_string($validated['tags'])) {
            $validated['tags'] = array_filter(array_map('trim', explode(',', $validated['tags'])));
        }

        $validated['is_favorite'] = $request->has('is_favorite');

        Resource::create($validated);

        return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        return view('resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\UpdateResourceRequest $request, Resource $resource)
    {
        $validated = $request->validated();
        
        if (isset($validated['tags']) && is_string($validated['tags'])) {
            $validated['tags'] = array_filter(array_map('trim', explode(',', $validated['tags'])));
        } elseif (!isset($validated['tags'])) {
            $validated['tags'] = [];
        }

        $validated['is_favorite'] = $request->has('is_favorite');

        $resource->update($validated);

        return redirect()->route('resources.index')->with('success', 'Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
    }

    /**
     * Toggle the favorite status of the specified resource.
     */
    public function toggleFavorite(Resource $resource)
    {
        $resource->update(['is_favorite' => !$resource->is_favorite]);

        return back()->with('success', 'Favorite status updated.');
    }
}
