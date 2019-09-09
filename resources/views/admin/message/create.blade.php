@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create message</div>

                    <div class="card-body">
                        <form method="get" action="{{route('message.store')}}">
                            @csrf {{--neleidzia submitint formos is kito saito--}}
                            <input name="subject" type="text" class="form-control mt-2"  placeholder="Subject">
                            <textarea name="message" type="text" class="form-control mt-2" placeholder="Message"></textarea>
                            <select name="type_id" class="form-control mt-2">
                                <option class="form-control">Tipas</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{$type->type}}</option>
                                @endforeach
                            </select>
                            <button class="btn alert-success mt-2">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
