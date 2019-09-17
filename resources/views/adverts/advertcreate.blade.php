@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti skelbimą</div>

                    <div class="card-body">
                        <form method="post" action="{{route('advert.store')}}">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="title" type="text" class="form-control mt-2"  placeholder="Pavadinimas">
                            <select name="category_id" class="form-control mt-2">
                                <option class="form-control">Pasirinkti kategorija</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <select name="attribute_id" class="form-control mt-2" required>
                                <option class="form-control">Atributai</option>
                                @foreach($attribute_set as $set)
                                    <option value="{{ $set->id }}">{{$set->name}}</option>
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
