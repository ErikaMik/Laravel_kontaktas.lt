@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{$advert->title}}</div>
                        <form method="post" action="{{route('advert.destroy', $advert->id)}}">
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark float-right btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="alert">Kategorija: {{$advert->category->title}}</div>
                <div class="card-body">
                    <div class="text-left">{{ $advert-> content}}</div>
                    <div class="card-columns mt-4">Kaina: {{ $advert->price}} €</div>
                    <div class="text-center"><img src="{{ $advert->image}}" alt="{{$advert->slug}}" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
                @foreach($comments as $comment)
                    <div class="card mt-2">
                        <div class="d-flex justify-content-between p-2 card-header">
                            <h6>{{$comment->user->name}} </h6>
                            <h6><small>{{$comment->created_at}}</small></h6>
                        </div>

                        <div class="p-2">{{ $comment->content}}</div>
                    </div>
                @endforeach
        </div>
        <div class="card-body col-md-8">
            <form method="post" action="{{route('comment.store')}}">
                @csrf {{--neleidzia submitint formos is kito saito--}}
                <textarea name="content_text" type="text" class="form-control mt-2" placeholder="Comment..."></textarea>
                <input type="hidden" value="{{$advert->id}}" name="adId">
                <input type="hidden" value="{{$advert->user_id}}" name="userId">
                <input type="hidden" value="{{$advert->slug}}" name="slug">
                <button class="btn alert-success mt-2">Comment</button>
            </form>
        </div>
    </div>
</div>
@endsection
