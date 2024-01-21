@php use App\Helper\FlightStatusHelper; @endphp
@section('content')
    @extends('adminlte::page')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-center">Flights</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('flights.create') }}">Start Flight</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Pilot</th>
                <th>Drone</th>
                <th>Status</th>
                <th>Start Flight</th>
                <th>Finish Flight</th>
                <th width="280px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($flights as $flight)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $flight->pilot->name }}</td>
                    <td>{{ $flight->drone->name }}</td>
                    <td>
                        <p>
                            {!! FlightStatusHelper::getStatusWithColor($flight->flight_status) !!}
                        </p>
                    </td>
                    <td>{{ $flight->start_date }}</td>
                    <td>{{ $flight->end_date }}</td>
                    <td>

                        <form method="POST" action="{{ route('flights.destroy', $flight->id) }}">
                            @if (!$flight->end_date)
                                <a type="button" class="btn btn-warning"
                                   href="{{ route('flights.stop', $flight->id) }}">Stop</a>
                            @endif
                            @if ($flight->end_date)
                                <a class="btn btn-primary" href="{{ route('flights.edit', $flight->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--{!! $flights->links() !!}--}}
    </div>
@endsection
