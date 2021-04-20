@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} Go to
                        @role('manager')
                            <a href="{{ route('dashboard-manager') }}">dashboard</a>.
                        @endrole

                        @role('client')
                        <a href="{{ route('dashboard-client') }}">dashboard</a>.
                        @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
