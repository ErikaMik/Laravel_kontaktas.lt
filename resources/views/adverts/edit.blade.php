@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Redaguoti skelbima</div>

                    <div class="card-body">
                        <form method="post" action="{{route('advert.update', $advert->id)}}">
                            @method('PUT')
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="title" type="text" class="form-control mt-2"  placeholder="Pavadinimas" value="{{$advert->title}}">
                            <textarea name="content_text" type="text" class="form-control mt-2" placeholder="Skelbimas">{{$advert->content}}</textarea>
                            <input name="image" type="text" class="form-control mt-2" placeholder="Image" value="{{$advert->image}}">
                            <input type="number" name="price" class="form-control mt-2" placeholder="Kaina" value="{{$advert->price}}">
                            <select name="category_id" class="form-control mt-2" required>
                                <option class="form-control">Pasirinkti kategorija</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <button class="btn alert-success mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
