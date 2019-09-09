@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti kategorija</div>
                    @if(session()->has('message'))
                        <div class="row justify-content-center">
                                <div class="alert alert-success alert-dismissible pt-2">
                                    {{session()->get('message')}}
                                </div>
                            </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action="{{route('category.store')}}">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="title" type="text" class="form-control mt-2" placeholder="Pavadinimas">
                            <select name="parent_id" class="form-control mt-2">
                                <option value="0">-----</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
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
