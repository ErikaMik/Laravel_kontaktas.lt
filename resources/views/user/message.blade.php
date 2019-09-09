@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card mt-2">
                        <div class="d-flex justify-content-between p-2 card-header">
                            <h6>{{$message->subject}}</h6>
                            <h6><small>{{$message->created_at}}</small></h6>
                        </div>
                        <div class="p-2">{{ $message->message}}</div>
                    </div>
            </div>
@endsection
