@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti kategorija</div>

                    <div class="card-body">
                        <form method="post" action="{{route('category.store')}}">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="title" type="text" class="form-control" placeholder="Pavadinimas">
                            <select name="parent_id" class="form-control">
                                <option value="0">-----</option>
                            </select>
                            <button class="btn alert-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
