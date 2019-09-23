<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $adverts = Advert::where('active', 1)->paginate(8);
        $data['adverts'] = $adverts;
        return view('home', $data);
    }
}
