@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti skelbima</div>

                    <div class="card-body">
                        <form method="post" action="">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="title" type="text" class="form-control" placeholder="Pavadinimas">
                            <textarea name="content" type="text" class="form-control" placeholder="Skelbimas"></textarea>
                            <input name="image" type="text" class="form-control" placeholder="Pavadinimas">
                            <input type="number" name="price" class="form-control" placeholder="Kaina">
                            <select name="category" class="form-control">
                                <option class="form-control">Pasirinkti kategorija</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{$cat->title}}</option>
                                    @endforeach
                            </select>
                            <button class="btn alert-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
