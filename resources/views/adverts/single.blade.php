@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{$advert->title}}</div>
                        <div class="d-flex justify-content-between">
                                @if(Auth::user() && (Auth::user()->hasRole('user') && Auth::user()->id == $advert->user_id || Auth::user()->hasRole('admin')))
                            {{--@role('admin|user')--}}
                                    <form method="post" action="{{url('advert/'.$advert->id.'/edit')}}">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-dark float-right btn-sm mr-2">Edit</button>
                                    </form>
                                    <form method="post" action="{{action('AdvertController@destroy', $advert->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark float-right btn-sm">Delete</button>
                                    </form>
                                @endif
                            {{--@endrole--}}
                        </div>
                    </div>
                </div>
                <div class="alert">Kategorija: {{$advert->category->title}}</div>
                <div class="card-body">
                    <div class="text-left">{{ $advert-> content}}</div>
                    <div class="card-columns mt-4">Kaina: {{ $advert->price}} €</div>
                    <div class="text-center"><img src="{{ $advert->image}}" alt="{{$advert->slug}}" class="img-fluid"></div>
                    @foreach($attributes as $attribute)
                        <div class="card mt-4">{{$attribute->attributes->label}}: {{$attribute->attributes->value->value}}</div>
                    @endforeach
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
                <input type="hidden" value="{{$advert->slug}}" name="slug">
                <button class="btn alert-success mt-2">Comment</button>
            </form>
        </div>
    </div>
</div>
@endsection
