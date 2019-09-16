@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti atributų rinkinį</div>
                    <div class="card-body">
                        <form method="get" action="{{route('attributes.storeSet')}}">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="name" type="text" class="form-control mt-2"  placeholder="Atribute set name">
                            <button class="btn alert-success mt-2">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti atributą</div>
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
                                <option class="form-control">Atributo rinkinys</option>
                                @foreach($sets as $set)
                                    <option value="{{ $set->id }}">{{ucfirst($set->name)}}</option>
                                @endforeach
                            </select>
                            <button class="btn alert-success mt-2">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection