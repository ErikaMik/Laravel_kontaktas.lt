<?php

namespace App\Http\Controllers;

use App\Message;
use App\Type;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //apsaugo, controleris pasiekiamas tik useriui.
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data['messages'] = Message::all()->where('receiver_id', auth()->id())->sortByDesc('status');
            return view('user.messages', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['types'] = Type::all();
        $user = Auth::user();
        if($user && ($user->hasRole('admin')))
        {
            return view('admin.message.create', $data);
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
        if($user && ($user->hasRole('admin'))){
            $users = User::all();
            //dd($users);
            foreach($users as $user){
                $message = new Message();
                $message->subject = $request->subject;
                $message->message = $request->message;
                $message->sender_id = auth()->id();
                $message->active = 1;
                $message->receiver_id = $user->id;
                $message->type_id = $request->type_id;

                $message->save();
            }
            return redirect()->back();
        }else{
            return view('auth.login');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        if($message->status != 0){
            $message->status = 0;
            $message->save();
        }
        $data['message'] = $message;
            return view('user.message', $data);

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
        //
    }
}
