@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>Sukurti atributų rinkinį</h4></div>
                    <div class="card-body">
                        <form method="get" action="{{route('attributes.storeSet')}}">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="name" type="text" class="form-control mt-2"  placeholder="Atribute set name">
                            <button class="btn alert-success mt-2">Sukurti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>Sukurti atributą</h4></div>
                    <div class="card-body">
                        <form method="get" action="{{route('attributes.storeAttribute')}}">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="name" type="text" class="form-control mt-2"  placeholder="Atributo vardas">
                            <select name="type_id" class="form-control mt-2">
                                <option class="form-control">Atributo tipas</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ucfirst($type->name)}}</option>
                                @endforeach
                            </select>
                            <select name="set_id" class="form-control mt-2">
                                <option class="form-control">Atributų rinkinys</option>
                                @foreach($sets as $set)
                                    <option value="{{ $set->id }}">{{ucfirst($set->name)}}</option>
                                @endforeach
                            </select>
                            <button class="btn alert-success mt-2">Sukurti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>Priskirti atributą(-us) rinkiniui</h4></div>
                    <div class="card-body">
                        <form method="post" action="{{route('attributes.setAttribute')}}">
                            @csrf
                            <div class="text-right"></div>

                            <select name="set_id" class="form-control mt-2">
                                <option class="form-control">Atributų rinkinys</option>
                                @foreach($sets as $set)
                                    <option value="{{ $set->id }}">{{ucfirst($set->name)}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn alert-success mt-2">Priskirti</button>
                            @foreach($attributes as $attribute)
                                <div class="col-md-8">
                                    <label for="{{$attribute->id}}">
                                        <input name="post[]" class="card-title mt-3 pl-2 pr-2" type="checkbox" id="{{$attribute->id}}" value="{{$attribute->id}}" class="mr-2">
                                        <span class="p-2">{{$attribute->label}}</span>
                                    </label>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection