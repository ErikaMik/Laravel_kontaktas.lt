@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Redaguoti skelbima</div>

                    <div class="card-body">
                        @role('admin|user')
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
                                    <option value="{{ $cat->id }}" {{($advert->category_id == $cat->id) ? 'selected':''}}>{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <select name="attribute_id" class="form-control mt-2" required>
                                <option class="form-control">Atributai</option>
                                @foreach($attribute_set as $set)
                                    <option value="{{ $set->id }}" {{ ( $set->id == $advert->attribute_set_id) ? 'selected' : '' }}>{{$set->name}}</option>
                                @endforeach
                            </select>


                            @foreach($attributes as $attribute)
                                @foreach($values as $value)
                                {{$value->attribute->label}}<input name="super_attributes_{{$attribute->attributes->name}}" type="{{$attribute->attributes->type->name}}" class="form-control mt-2"  placeholder="{{ucfirst($value->attribute->label)}}" value="{{$value->value}}">
                                @endforeach
                            @endforeach

                            <select name="active" class="form-control mt-2" required>
                                <option class="form-control">Choose status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Disabled</option>
                            </select>

                            <button class="btn alert-success mt-2">Update</button>

                        </form>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
