<?php

namespace App\Repository;

use App\Models\Pilot;

class PilotRepository
{
    public function getAllPilot()
    {
        return Pilot::all();
    }

    public function getPilotWithOutFlight()
    {
        return Pilot::where('status', '!=', Pilot::STATUS_FLIGHT)->get();
    }

    public function findById($id)
    {
        return Pilot::find($id);
    }

    public function changeStatusPilot(int $pilot_id, string $status)
    {
        $model = Pilot::find($pilot_id);
        if($model) {
            $model->status = $status;
            $model->update();
        }
        return true;
    }
}
