@extends('layouts.app')
<style>

    /*https://html-cleaner.com/features/replace-html-table-tags-with-divs/*/
    /*.rTable {*/
        /*display: table;*/
        /*width: 50%;*/
    /*}*/
    /*.rTableRow {*/
        /*display: table-row;*/
    /*}*/
    /*.rTableHeading {*/
        /*display: table-header-group;*/
        /*background-color: #ddd;*/
    /*}*/
    /*.rTableCell, .rTableHead {*/
        /*display: table-cell;*/
        /*padding: 3px 10px;*/
        /*border: 1px solid #999999;*/
        /*width: 50%;*/
    /*}*/
    /*.rTableHeading {*/
        /*display: table-header-group;*/
        /*background-color: #ddd;*/
        /*font-weight: bold;*/
    /*}*/
    /*.rTableFoot {*/
        /*display: table-footer-group;*/
        /*font-weight: bold;*/
        /*background-color: #ddd;*/
    /*}*/
    /*.rTableBody {*/
        /*display: table-row-group;*/
    /*}*/

    .rTable { display: table; }
    .rTableRow { display: table-row; }
    .rTableHeading { display: table-header-group; }
    .rTableBody { display: table-row-group; }
    .rTableFoot { display: table-footer-group; }
    .rTableCell, .rTableHead { display: table-cell; }


    #main {

        display: flex;
    }

    #main div {
        flex-grow: 0;
        flex-shrink: 0;
        /*flex-basis: 40px;*/
    }


</style>
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
                    <button type="submit" class="btn btn-dark btn-sm" >Delete checked</button>
                    @foreach($cities as $city)
                        <div class="rTableRow">
                            <div class="rTableCell"><input name="post[]" type="checkbox" value="{{$city->id}}"></div>
                        </div>
                        <div class="rTableRow">
                            <div class="rTableCell">{{$city->name}}</div>
                            <div class="rTableCell">
                                <a href="#" type="submit" role="button"  class="btn btn-dark btn-sm">
                                    EDIT
                                </a>
                            </div>
                        </div>
                    @endforeach
                </form>





        {{--<div id="main">--}}
                {{--<div>--}}
                    {{--<form method="post" action="{{route('city.clear')}}">--}}
                        {{--@csrf--}}
                        {{--<button type="submit" class="btn btn-dark btn-sm" >Delete checked</button>--}}
                        {{--@foreach($cities as $city)--}}
                            {{--<div class="rTableRow">--}}
                                {{--<div class="rTableCell"><input name="post[]" type="checkbox" value="{{$city->id}}"></div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--@foreach($cities as $city)--}}
                        {{--<div class="rTableRow">--}}
                            {{--<div class="rTableCell">{{$city->name}}</div>--}}
                                {{--<div class="rTableCell">--}}
                                    {{--<a href="#" type="submit" role="button"  class="btn btn-dark btn-sm">--}}
                                        {{--EDIT--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--<div class="rTableCell">--}}
                            {{--<form method="post" action="{{route('city.destroy', $city->id)}}">--}}
                                {{--@csrf--}}
                                {{--@method('DELETE')--}}
                                {{--<button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Are you sure?')">Delete</button>--}}
                            {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
        {{--</div>--}}
            </div>
        </div>
    </div>
@endsection
