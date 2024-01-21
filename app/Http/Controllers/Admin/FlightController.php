<?php

namespace App\Http\Controllers\Admin;

use App\Helper\PilotStatusHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Models\Flight;
use App\Models\Pilot;
use App\Repository\FlightRepository;
use App\Repository\PilotRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FlightRepository $flightRepository)
    {
        $flights = $flightRepository->getAllFlights();
        return view('flights.index', compact('flights'));
    }

    public function flightToDay(FlightRepository $flightRepository)
    {
        $flights = $flightRepository->getAllFlightsToDay();
        return view('flights.today', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PilotRepository $pilotRepository)
    {
        $pilots = $pilotRepository->getPilotWithOutFlight();
        return view('flights.create', compact('pilots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlightRequest $request,
                          FlightRepository $flightRepository,
                          PilotRepository $pilotRepository
    )
    {
        $request->validated();

        $save = $flightRepository->createFlight($request);

        if($save) {
            $pilotRepository->changeStatusPilot($request->get('pilot_id'), PilotStatusHelper::STATUS_FLIGHT);
            return redirect()
                ->route('flights.today')
                ->with('success','Flight has been created successfully.');
        }
        return redirect()
            ->route('flights.today')
            ->with('error','Error occurred while saving.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight, PilotRepository $pilotRepository)
    {
        $pilots = $pilotRepository->getPilotWithOutFlight();
        return view('flights.edit', compact(['flight', 'pilots']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Flight $flight,
                           UpdateFlightRequest $request,
                           PilotRepository $pilotRepository,
                           FlightRepository $flightRepository
    )
    {
        $request->validated();
        $update = $flightRepository->updateFlight($request, $flight);
        if($update) {
            $pilotRepository->changeStatusPilot($flight->pilot_id, PilotStatusHelper::STATUS_AVAILABLE);

            return redirect()
                ->route('flights.today')
                ->with('success','Flight has been update successfully.');
        }

        return redirect()
            ->route('flights.today')
            ->with('error','Some error');
    }

    public function stop(Flight $flight,
                         FlightRepository $flightRepository,
                         PilotRepository $pilotRepository
    )
    {
        $stop_flight = $flightRepository->stopFlight($flight);
        if($stop_flight) {
            $pilotRepository->changeStatusPilot($flight->pilot_id, PilotStatusHelper::STATUS_AVAILABLE);
            return redirect()
                ->route('flights.today')
                ->with('success','The Flight is over.');
        }

        return redirect()
            ->route('flights.today')
            ->with('error','Some error');
    }

    public function destroy($id, PilotRepository $pilotRepository)
    {
        $flight = Flight::find($id);
        if($flight->delete()) {
            $pilotRepository->changeStatusPilot($flight->pilot_id, Pilot::STATUS_AVAILABLE);
        }
        return redirect()
            ->route('flights.today')
            ->with('success','Flight has been delete successfully.');
    }
}
