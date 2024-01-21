@section('content')
    @extends('adminlte::page')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2 class="text-center">Start Flight</h2>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('flights.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pilot_id">Pilot</label>
                <select class="form-control" id="pilot_id" name="pilot_id">
                    <option selected>Open this select pilot</option>
                    @foreach($pilots as $pilot)
                        <option value="{{ $pilot->id }}">{{ $pilot->name }}</option>
                    @endforeach
                </select>
                @error('pilot_id')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <strong>Drone</strong>
                <input type="text" name="drone" class="form-control" placeholder="Drone">
                @error('drone')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="btn-group">
                <a class="btn btn-primary" href="{{ route('flights.index') }}">Back</a>
                <button type="submit" class="btn btn-success ml-1">Start</button>
            </div>
        </form>
    </div>
@endsection
