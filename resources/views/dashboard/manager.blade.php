@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard (Manager Area)') }}</div>

                <div class="card-body">
                    <h2>Clients Requests</h2>

                    @if($errors->any())
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                    <ul>
                                        @foreach($errors->all() as $errorTxt)
                                            <li>{{ $errorTxt }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dashboard.store') }}">
                        @csrf
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>✅</th>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Client Name</th>
                                <th>Client Email</th>
                                <th>File</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $request)
                                @php /** @var \App\Models\Request $request */ @endphp
                                <tr>
                                    <td>
                                        @if($request->checked)
                                            ✅
                                        @else
                                            <input name="checked-{{ $request->id }}"
                                                   type="checkbox"
                                                   id="checked-{{ $request->id }}"
                                                   value="1"
                                            >
                                        @endif
                                    </td>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->subject }}</td>
                                    <td>{{ $request->message }}</td>
                                    <td>{{ $request->user->name }}</td>
                                    <td>{{ $request->user->email }}</td>
                                    <td>{{ $request->file_path }}</td>
                                    <td>{{ \Carbon\Carbon::parse($request->published_at)->format('d.M H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Check Selected</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
