
@section('content')
    @extends('adminlte::page')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2 class="text-center">Pilots</h2>
                    </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('pilots.create') }}"> Create pilot</a>
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
                    <th>Pilot Name</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pilots as $pilot)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pilot->name }}</td>
                        <td>{{ \App\Helper\PilotStatusHelper::getStatus($pilot->status) }}</td>
                        <td>
                            <form action="{{ route('pilots.destroy',$pilot->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('pilots.edit',$pilot->id) }}">Edit</a>
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
