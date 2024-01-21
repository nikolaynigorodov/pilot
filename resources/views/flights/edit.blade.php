@php use App\Helper\FlightStatusHelper; @endphp
@section('content')
    {{--@push('style')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush--}}
    @extends('adminlte::page')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2 class="text-center">Update Flight</h2>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('flights.update', $flight->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pilot_id">Pilot</label>
                <select class="form-control" id="pilot_id" name="pilot_id">
                    <option selected>Open this select pilot</option>
                    @foreach($pilots as $pilot)
                        <option
                            value="{{ $pilot->id }}" {{ $pilot->id == $flight->pilot->id ? 'selected' : ''}}>{{ $pilot->name }}</option>
                    @endforeach
                </select>
                @error('pilot_id')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="drone_id">Drone</label>
                <select class="form-control" id="drone_id" name="drone_id">
                    <option selected>Open this select drone</option>
                    @foreach($drones as $drone)
                        <option
                            value="{{ $drone->id }}" {{ $drone->id == $flight->drone->id ? 'selected' : ''}}>{{ $drone->name }}</option>
                    @endforeach
                </select>
                @error('drone_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="flight_status">Status</label>
                <select class="form-control" id="flight_status" name="flight_status">
                    <option selected>Open this select status</option>
                    @foreach(FlightStatusHelper::getArrayStatus() as $number => $name)
                        <option
                            value="{{ $number }}" {{ $flight->flight_status == $number ? 'selected' : ''}}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('flight_status')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            {{--<div class="mb-3 row">
                <label for="join"
                       class="col-md-4 col-form-label text-md-end">{{ __('Start Flight') }}</label>

                <div class="col-md-6">
                    <input type="datetime-local" class="form-control" name="start_date" value="{{ $flight->start_date }}">
                </div>
            </div>--}}
            <div class="form-group">
                <label for="start_date">Flight Start</label>
                    <input class="form-control" id="start_date" type="datetime-local" name="start_date" value="{{ $flight->start_date }}">
                @error('start_date')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date">Flight End</label>
                    <input class="form-control" id="end_date" type="datetime-local" name="end_date" value="{{ $flight->end_date }}">
                @error('end_date')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="btn-group">
                <a class="btn btn-primary" href="{{ route('flights.index') }}">Back</a>
                <button type="submit" class="btn btn-success ml-1">Update Start Flight</button>
            </div>
        </form>
    </div>
    {{--@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("input[type=datetime-local]");
        </script>
    @endpush--}}
@endsection
