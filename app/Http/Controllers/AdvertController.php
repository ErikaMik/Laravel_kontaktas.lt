<?php

namespace App\Http\Controllers;

use App\Attribute_set;
use App\Category;
use App\Advert;
use App\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adverts = Advert::active()->get();
        $data['adverts'] = $adverts;
        return view('home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user && ($user->hasRole('admin') || $user->hasRole('user')))
        {
            $categories = Category::where('active', 1)->get();
            $data['categories'] = $categories;
            //dd($categories); debuginimas
            return view('adverts.create', $data);
        }else{
            return view('auth.login');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $advert = new Advert();
        $advert->title = $request->title;
        $advert->content = $request->content_text;
        $advert->category_id = $request->category_id;
        $advert->city_id = 1;
        $advert->user_id = $user->id;
        $advert->price = $request->price;
        $advert->image = $request->image;

        $lastid = Advert::all()->last();
        $id = $lastid->id;
        $id = $id + 1;

        $advert->slug = Str::slug($request->title, '-').'-'.$id;
        $advert->save();
        return redirect()->action('AdvertController@show', $advert->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show(Advert $advert)
    {
        //$advert = Advert::where('slug', $slug)->first();
        $data['advert'] = $advert;

        $data['comments'] = Comments::where('active', 1)->where('advert_id', $advert->id)->get();

        return view('adverts.single', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //uzkrauna forma editinimui
        $advert = Advert::find($id);
        $categories = Category::where('active', 1)->get();
        $attribute_set = Attribute_set::all();
        $data['attributes'] = $advert->attributeSet->relations;
        
        $data['advert'] = $advert;
        $data['categories'] = $categories;
        $data['attribute_set'] = $attribute_set;

        return view('adverts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Uzkrauna i duomenu baze
        $user = auth()->user();
        $advert = Advert::find($id);
        $advert->title = $request->title;
        $advert->content = $request->content_text;
        $advert->category_id = $request->category_id;
        $advert->city_id = 1;
        $advert->user_id = $user->id;
        $advert->price = $request->price;
        $advert->image = $request->image;
        $advert->active = $request->active;
        $advert->slug = Str::slug($request->title, '-');
        $advert->attribute_set_id = $request->attribute_id;
        $advert->save();
        //$data['advert'] = $advert;
        //return view('adverts.single', $data);
        return redirect()->action('AdvertController@show', $advert->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advert = Advert::find($id);
        $advert->active = 0;
        $advert->save();
        $user = Auth::user();
        if($user && ($user->hasRole('admin'))){
            return redirect()->action('AdminController@index');
        }else{return redirect()->action('HomeController@index');}
    }
}
