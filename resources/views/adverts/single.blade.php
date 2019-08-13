@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$advert->title}}</div>
                <div class="alert">Kategorija: {{$advert->category->title}}</div>
                <div class="card-body">
                    <div class="text-left">{{ $advert-> content}}</div>
                    <div class="card-columns mt-4">Kaina: {{ $advert-> price}} €</div>
                    <div class="text-center"><img src="{{ $advert-> image}}" alt="{{$advert->slug}}" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                @foreach($comments as $comment)
                    <div class="card-body">
                        <h6>{{$comment->created_at}}</h6>
                        <div>{{ $comment->content}}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-body col-md-8">
            <form method="post" action="{{route('comment.store')}}">
                @csrf {{--neleidzia submitint formos is kito saito--}}
                <textarea name="content_text" type="text" class="form-control mt-2" placeholder="Comment..."></textarea>
                <input type="hidden" value="{{$advert->id}}" name="adId">
                <input type="hidden" value="{{$advert->user_id}}" name="userId">
                <button class="btn alert-success mt-2">Comment</button>
            </form>
        </div>
    </div>
</div>
@endsection
