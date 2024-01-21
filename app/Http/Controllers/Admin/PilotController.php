<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pilot;
use Illuminate\Http\Request;

class PilotController extends Controller
{
    const MIN_COUNT_OF_PAGE = 10;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pilots = Pilot::all();
        return view('pilots.index', compact('pilots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pilots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Pilot::create($request->post());

        return redirect()
            ->route('pilots.index')
            ->with('success','Pilot has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pilot $pilot)
    {
        return view('pilot.show',compact('pilot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pilot $pilot)
    {
        return view('pilots.edit',compact('pilot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pilot $pilot)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $pilot->fill($request->post())->save();

        return redirect()->route('pilots.index')->with('success','Pilot Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pilot $pilot)
    {
        $pilot->delete();
        return redirect()->route('pilots.index')->with('success','Pilots has been deleted successfully');
    }
}
