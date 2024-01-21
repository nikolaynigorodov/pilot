<?php

namespace App\Repository;

use App\Helper\FlightStatusHelper;
use App\Models\Flight;
use App\Models\Pilot;
use Illuminate\Support\Carbon;

class FlightRepository
{
    public function getAllFlights()
    {
        return Flight::all();
    }

    public function getAllFlightsToDay()
    {
        $date = new Carbon();
        $start = $date->startOfDay();

        return Flight::where('start_date', '>', $start)->get();
    }

    public function createFlight($request)
    {
        return Flight::create([
            'drone_id' => $request->drone_id,
            'pilot_id' => $request->pilot_id,
            'flight_status' => FlightStatusHelper::STATUS_FLIGHT,
            'start_date' => Carbon::now(),
        ]);
    }

    public function updateFlight($request, Flight $flight)
    {
        //return $flight->fill($request->post())->save();
        return $flight->fill($request->post())->update();
    }

    public function stopFlight(Flight $flight)
    {
        return $flight->fill([
            'end_date' => Carbon::now(),
            'flight_status' => FlightStatusHelper::STATUS_END_FLIGHT
        ])->update();
    }
}
