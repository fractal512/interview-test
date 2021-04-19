@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard (Client)') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form method="POST" action="{{ route('dashboard.store') }}" enctype="multipart/form-data">

                            @csrf

                            <div id="maindata" class="tab-pane active" role="tabpanel">
                                <div class="form-group">
                                    <label for="title">Subject</label>
                                    <input name="title" value=""
                                           id="title"
                                           type="text"
                                           class="form-control"
                                           minlength="3"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="content_raw">Message</label>
                                    <textarea name="content_raw"
                                              id="content_raw"
                                              class="form-control"
                                              rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="label" for="file">Select file</label>
                                    <input type="file" name="file" class="form-control-file" id="file">
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
