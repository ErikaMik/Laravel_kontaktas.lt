@extends('layouts.app')

@section('content')

    {{--Neaprasytas Routas, neparuosta--}}



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($messages as $message)
                    <div class="card mt-2">
                        <div class="d-flex justify-content-between p-2 card-header">
                            <h6><a class="nav-link" href="{{route('message.show', $message->id)}}"> {{$message->subject}} {{($message->status == 1) ? "(Unread)" : ""}} </a></h6>
                            <h6><small>{{$message->created_at}}</small></h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
