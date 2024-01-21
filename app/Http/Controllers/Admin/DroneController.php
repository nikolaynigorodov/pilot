<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DroneStoreRequest;
use App\Http\Requests\DroneUpdateRequest;
use App\Models\Drone;
use App\Repository\DroneRepository;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DroneRepository $droneRepository)
    {
        $drones = $droneRepository->getAllDrones();
        return view('drones.index', compact('drones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DroneStoreRequest $request, DroneRepository $droneRepository)
    {
        $request->validated();
        $save = $droneRepository->createDrone($request);

        if($save) {
            return redirect()
                ->route('drones.index')
                ->with('success','Drone has been created successfully.');
        }

        return redirect()
            ->route('drones.index')
            ->with('error','Error occurred while saving.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Drone $drone)
    {
        return view('drones.edit',compact('drone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Drone $drone,
                           DroneUpdateRequest $request,
                           DroneRepository $droneRepository
    )
    {
        $request->validated();

        $update = $droneRepository->updateDrone($request, $drone);
        if($update) {
            return redirect()
                ->route('drones.index')
                ->with('success','Drone has been update successfully.');
        }

        return redirect()
            ->route('drone.index')
            ->with('error','Some error');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drone $drone)
    {
        $drone->delete();
        return redirect()->route('drones.index')->with('success','Drone has been deleted successfully');
    }
}
