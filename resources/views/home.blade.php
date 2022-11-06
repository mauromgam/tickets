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

                        @foreach($tickets as $ticket)
                            <div class="card {{ $ticket['status'] ? 'border-success' : 'border-warning' }}">
                                <div class="card-body">
                                    <div class="card-title">
                                        Subject: {{ $ticket['subject'] }}
                                    </div>
                                    <div class="card-subtitle">
                                        Raised by: {{ $ticket['user_name'] }}
                                    </div>
                                    <div class="card-text">
                                        Content: {{ $ticket['content'] }}
                                    </div>
                                </div>
                            </div>
                            <div>&nbsp;</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
