<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Advert;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['adverts'] = Advert::all();
        $data['categories'] = Category::all();
        $cities = City::all()->sortBy('name');
        $data['cities'] = $cities;
        return view('admin.city', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oldValue = City::where('name', $request->city)->first();;
        if(!is_null($request->city) && $oldValue === null){
            $city = new City();
            $city->name = $request->city;
            $city->save();
        }else{
            if(!is_null($request->city)){
                $oldValue->name = $request->city;
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_array($id))
        {
            City::destroy($id);
            return redirect()->back();
        }
        else
        {
            City::findOrFail($id)->delete();
            return redirect()->back();
        }

        //$city = City::find($id);
        //$city->delete();
        //$user = Auth::user();
        //if($user && ($user->hasRole('admin'))){
        //    return redirect()->back();
        //}else{
        //    return redirect()->back();
        //}

    }

    public function clear(Request $request)
    {
        $post = $request->input('post');
        ///dd($post);
        if (is_array($post))
        {
            City::destroy($post);
            return redirect()->back();
        }
        else
        {
            City::findOrFail($post)->delete();
            return redirect()->back();
        }
    }
}
