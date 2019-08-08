<?php

namespace App\Http\Controllers;

use App\Category;
use App\Advert;
use Illuminate\Http\Request;
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
        return view('adverts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('active', 1)->get();
        $data['categories'] = $categories;
        //dd($categories); debuginimas
        return view('adverts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $advert = new Advert();
        $advert->title = $request->title;
        $advert->content = $request->content_text;
        $advert->category_id = $request->category_id;
        $advert->city_id = 1;
        $advert->user_id = 1;
        $advert->price = $request->price;
        $advert->image = $request->image;
        $advert->slug = Str::slug($request->title, '-');
        $advert->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advert = Advert::find($id);
        $data['advert'] = $advert;
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
        $data['advert'] = $advert;
        $data['categories'] = $categories;

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
        $advert = Advert::find($id);
        $advert->title = $request->title;
        $advert->content = $request->content_text;
        $advert->category_id = $request->category_id;
        $advert->city_id = 1;
        $advert->user_id = 1;
        $advert->price = $request->price;
        $advert->image = $request->image;
        $advert->slug = Str::slug($request->title, '-');
        $advert->save();
        $data['advert'] = $advert;
        return view('adverts.single', $data);
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
    }
}
