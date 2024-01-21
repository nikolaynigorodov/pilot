<?php

namespace App\Repository;

use App\Models\Drone;
use App\Models\Pilot;

class DroneRepository
{
    public function createDrone($request)
    {
        return Drone::create([
            'name' => $request->name,
        ]);
    }

    public function updateDrone($request, Drone $drone)
    {
        return $drone->fill($request->post())->update();
    }

    public function getAllDrones()
    {
        return Drone::all();
    }
}
