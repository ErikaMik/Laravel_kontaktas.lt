@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @foreach($adverts as $advert)
                            <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                                <div class="card">
                                    <img class="card-img-top" src="{{ $advert->image}}" alt="{{$advert->slug}}">
                                    <div class="card-block">
                                        <h4 class="card-title mt-3 pl-2 pr-2">{{$advert->title}}</h4>
                                        <div class="card-text pl-2 pr-2 pb-2 mb-2">
                                            {{ Str::words($advert->content, 10, '...')}}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <small>Kaina: {{ $advert-> price}} €</small>
                                        <br><small>Įdėta: {{$advert->created_at->format('Y-d-m')}}</small>
                                        {{--<a href="http://194.5.157.97/laravel/test/public/advert/{{$advert->slug}}" class="btn btn-dark float-right btn-sm">show</a>--}}
                                        <a href="{{route('advert.show', $advert->slug)}}" class="btn btn-dark float-right btn-sm">show</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

    </div>
    <div class="row d-flex justify-content-center">
            <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                {{$adverts->links()}}
            </div>
    </div>
</div>
@endsection
