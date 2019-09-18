<?php

namespace App\Http\Controllers;

use App\Attribute_set;
use App\Attribute_values;
use App\Attributes;
use App\Category;
use App\Advert;
use App\Comments;
use App\User;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Attribute;


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

    public function advertCreate()
    {
        $user = Auth::user();
        if($user && ($user->hasRole('admin') || $user->hasRole('user'))){
            $data['categories'] = Category::where('active', 1)->get();
            $data['attribute_set'] = Attribute_set::all();
            return view('adverts.advertcreate', $data);
        }else{
            return view('auth.login');
        }
    }

//    public function create()
//    {
//        $user = Auth::user();
//        if($user && ($user->hasRole('admin') || $user->hasRole('user')))
//        {
//            $categories = Category::where('active', 1)->get();
//            $data['categories'] = $categories;
//            $attribute_set = Attribute_set::all();
//            $data['attribute_set'] = $attribute_set;
//            //dd($categories); debuginimas
//            return view('adverts.create', $data);
//        }else{
//            return view('auth.login');
//        }
//
//    }

    public function create()
    {
        $user = Auth::user();
        if($user && ($user->hasRole('admin') || $user->hasRole('user')))
        {
            $categories = Category::where('active', 1)->get();
            $data['categories'] = $categories;
            $attribute_set = Attribute_set::all();
            $data['attribute_set'] = $attribute_set;
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

    public function initializeAd(Request $request)
    {
        $user = auth()->user();
        $advert = new Advert();
        $advert->title = $request->title;
        $advert->content = '';
        $advert->category_id = $request->category_id;
        $advert->attribute_set_id = $request->attribute_id;
        $advert->city_id = 1;
        $advert->user_id = $user->id;
        $advert->price = null;
        $advert->image = null;
        $advert->active = 0;

        $lastid = Advert::all()->last();
        $id = $lastid->id;
        $id = $id + 1;

        $advert->slug = Str::slug($request->title, '-').'-'.$id;
        $advert->save();
        return redirect()->action('AdvertController@edit', $advert->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show(Advert $advert)
    {
        $data['advert'] = $advert;
        $data['values'] = Attribute_values::where('advert_id', $advert->id)->get();
        $data['attributes'] = $advert->attributeSet->relations;
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
        $data['values'] = Attribute_values::where('advert_id', $advert->id)->get();


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
        $data  = $request->except('_token');
        //dd($data);
        $attributes = [];
        foreach ($data as $key => $single){
            if(strpos($key, 'super_attributes_' )!== false){
                $attributeName = str_replace('super_attributes_', '', $key);
                $attributes[$attributeName] = $single;
            }
        }

        foreach ($attributes as $name => $value){
            $attributeObject = Attributes::where('name', $name)->first();
            //dd($attributes);
            $oldValue = Attribute_values::where('attribute_id',$attributeObject->id)
                ->where('advert_id',$id)->first();
            if(!is_null($value)){
                if($oldValue === null){
                    $newValue = new Attribute_values();
                    $newValue->attribute_id = $attributeObject->id;
                    $newValue->advert_id = $id;
                    $newValue->value = $value;
                    $newValue->save();
                }else{
                    $oldValue->value = $value;
                    $oldValue->save();
                }
            }
        }

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
        $advert->slug = Str::slug($request->title, '-').'-'.$id;
        $advert->attribute_set_id = $request->attribute_id;
        $advert->save();

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
