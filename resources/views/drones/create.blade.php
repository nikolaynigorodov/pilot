@section('content')
    @extends('adminlte::page')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2 class="text-center">Add Drone</h2>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('drones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Drone Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Drone" required>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary ml-2" href="{{ route('drones.index') }}">Back</a>
                </div>
                <button type="submit" class="btn btn-success ml-1">Create</button>
            </div>
        </form>
    </div>
@endsection
