@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Skelbimai</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @foreach($adverts as $advert)
                            <div class="card">
                                <a href="http://194.5.157.97/laravel/test/public/advert/{{$advert->id}}" class="text-body" style="text-decoration: none"><div class="card-header">{{$advert->title}}</div>

                                <div class="card-body">
                                    <div class="card-columns">Kaina: {{ $advert-> price}} €</div>
                                    <div class="text-center"><img src="{{ $advert-> image}}" alt="{{$advert->slug}}" class="img-fluid"></div>
                                    <div class="card-columns"><p class="text-justify">{{ $advert-> content}}</p></div>
                                </div></a>
                            </div>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
