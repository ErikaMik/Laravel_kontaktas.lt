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
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('message.create')}}">Create message</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('attributes.index')}}">Create attributes</a>
                            </li>
                        </ul>
                    </div>
                </nav>


                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($adverts as $advert)
                    <tr>
                        <td><input name="post[]" type="checkbox" value="{{$advert->id}}"></td>
                        <td>{{$advert->title}}</td>
                        <td width="400px">{{ Str::words($advert->content, 10, '...')}}</td>
                        <td><img src="{{$advert->image}}" width="150px"></td>
                        <td>{{($advert->active == 1) ? "Active" : "Disabled"}}</td>
                        <td>
                            <a href="{{url('advert/'.$advert->id.'/edit')}}" type="submit" role="button"  class="btn btn-dark btn-sm">
                            EDIT
                            </a>
                        </td>
                        <td>
                            <form method="post" action="{{action('AdvertController@destroy', $advert->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
