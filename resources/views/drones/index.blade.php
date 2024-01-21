
@section('content')
    @extends('adminlte::page')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2 class="text-center">Drones</h2>
                    </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('drones.create') }}">Create Drone</a>
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
                    <th>Drone Name</th>
                    <th width="280px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($drones as $drone)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $drone->name }}</td>
                        <td>
                            <form action="{{ route('drones.destroy',$drone->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('drones.edit',$drone->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--{!! $pilots->links() !!}--}}
        </div>
@endsection
