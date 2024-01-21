@section('content')
    @extends('adminlte::page')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-center">Edit Drone: {{ $drone->name }}</h2>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('drones.update',$drone->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" name="name" value="{{ $drone->name }}" class="form-control"
                               placeholder="drone">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary ml-2" href="{{ route('drones.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
                <button type="submit" class="btn btn-success ml-2">Edit</button>
            </div>
        </form>
    </div>
@endsection
