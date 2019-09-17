@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                        </ul>
                    </div>
                </nav>

                <div class="card mt-3">
                    <div class="card-header">
                        Miestai
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{route('city.store')}}">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="city" type="text" class="form-control mt-2"  placeholder="Miestas">
                            <button class="btn alert-success mt-2">Create</button>
                        </form>
                    </div>
                </div>
                <form method="post" action="{{route('city.clear')}}">
                    @csrf
                    <div class="text-right"><button type="submit" class="btn btn-dark btn-sm mt-2 p-2">Delete selected</button></div>
                    @foreach($cities as $city)

                            <div class="col-md-8">
                                <label for="{{$city->id}}">
                                <h4 class="card-title mt-3 pl-2 pr-2"><input name="post[]" type="checkbox" id="{{$city->id}}" value="{{$city->id}}" class="mr-2">{{$city->name}}</h4>
                                </label>
                            </div>

                    @endforeach
                </form>
            </div>
        </div>
    </div>
@endsection
