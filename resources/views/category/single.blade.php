@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$category->title}}</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($category->adverts as $advert)
                                <div class="col-3">
                                    <h2 class="card-subtitle">{{$advert->title}}</h2>
                                    <div class="text-center">{{$advert->content}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
