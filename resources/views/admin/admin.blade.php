@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col bg-dark">
                <nav class="navbar navbar-expand-lg navbar-dark ">
                    <a class="navbar-brand" href="http://194.5.157.97/laravel/test/public/admin">Admin</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li>
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Cetgories
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($categories as $key => $c)
                                        <a style="padding-left: 20px" class="dropdown-item" href="{{route('admin.show', $c->slug)}}">{{$c->title}}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('city.index')}}">Cities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('message.create')}}">Create message</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('attributes.index')}}">Create attributes</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>


    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <form method="post" action="{{route('advert.deletePermanent')}}">
                @csrf
                <div ><button type="submit" class="btn btn-dark btn-sm mt-2 p-2" onclick="return confirm('Are you sure you want to delete these ads?')">DELETE selected</button></div>
            @foreach($adverts as $advert)
            <div class="card mt-2" style="background-color:{{($advert->active == 0)?  '#CDCDCD;' : ''}}">
                <div class="row align-items-center h-100">
                <div class="col-auto m-2">
                    <input name="post[]" type="checkbox"  value="{{$advert->id}}">
                </div>
                <div class="col m-2">
                    {{$advert->title}}<br>{{$advert->created_at}}
                </div>
                    <div class="col m-2">{{ Str::words($advert->content, 10, '...')}}</div>
                <div class="col col-auto m-2"><a href="http://194.5.157.97/laravel/test/public/advert/{{$advert->slug}}"><img src="{{$advert->image}}" width="150px"></a></div>
                <div class="col col-auto m-2">{{($advert->active == 1) ? "Active" : "Disabled"}}</div>
                <div class="col col-auto m-2">
                    <a href="{{url('advert/'.$advert->id.'/edit')}}" type="submit" role="button"  class="btn btn-dark btn-sm">
                        EDIT
                    </a>
                    <a href="{{url('advert/destroy/'.$advert->id)}}" type="submit" role="button"  class="btn btn-dark btn-sm ml-2">
                        DISABLE
                    </a>
                </div>
                </div>
            </div>
            @endforeach
            </form>
        </div>
    </div>
@endsection
