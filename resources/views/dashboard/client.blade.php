@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard (Client Area)') }}</div>

                <div class="card-body">
                    <h2>New Request</h2>

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

                        <form method="POST" action="{{ route('dashboard-client.store') }}" enctype="multipart/form-data">

                            @csrf

                            <div id="maindata" class="tab-pane active" role="tabpanel">
                                <div class="form-group">
                                    <label for="subject">Subject:</label>
                                    <input name="subject" value=""
                                           id="subject"
                                           type="text"
                                           class="form-control"
                                           minlength="3"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message:</label>
                                    <textarea name="message"
                                              id="message"
                                              class="form-control"
                                              rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="label" for="file">Select file:</label>
                                    <input type="file" name="file" class="form-control-file" id="file" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Send Request</button>
                                </div>
                            </div>

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
