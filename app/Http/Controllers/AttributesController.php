<?php

namespace App\Http\Controllers;

use App\Attribute_set;
use App\Attribute_types;
use App\Attributes;
use App\Attributes_set_relations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user && ($user->hasRole('admin'))){
            $data['types'] = Attribute_types::all();
            $data['sets'] = Attribute_set::all();
            return view('admin.attributes', $data);
        }else{
            return view('auth.login');
        }
    }

    public function storeSet(Request $request)
    {
        $set = new Attribute_set();
        $set->name = $request->name;
        $set->save();
        return redirect()->back();
    }

    public function storeAttribute(Request $request)
    {
        $attribute = new Attributes();
        $set = new Attributes_set_relations();

        $attribute->name = $request->name;
        $attribute->label = ucfirst($request->name);
        $attribute->type_id = $request->type_id;
        $attribute->save();

        $attribute = Attributes::where('name', $request->name)->first();
        $set->attribute_set_id = $request->set_id;
        $set->attribute_id = $attribute->id;
        $set->save();

        return redirect()->back();
    }

}
