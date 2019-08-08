@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$advert->title}}</div>

                <div class="card-body">

                    <div class="card-columns">{{ $advert-> content}}</div>
                    <div class="card-columns">Kaina: {{ $advert-> price}} €</div>
                    <div class="text-center"><img src="{{ $advert-> image}}" alt="{{$advert->slug}}" class="img-fluid"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
