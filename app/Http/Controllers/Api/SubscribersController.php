<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Subscribers;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::all();
        //echo 'ok';
        return Subscribers::collection($subscribers);
    }

    public function create(Request $request)
    {
        $subscriber = new Subscriber();
        $subscriber->name = $request->name;
        $subscriber->email = $request->email;
        $subscriber->save();

    }

    public function delete($email)
    {
        $subscriber = Subscriber::where('email', $email)->first();
        $subscriber->delete();
    }
}
