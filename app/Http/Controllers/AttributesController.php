<?php

namespace App\Http\Controllers;

use App\Attribute_set;
use App\Attribute_types;
use App\Attributes;
use App\Attributes_set_relations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Attribute;

class AttributesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user && ($user->hasRole('admin'))){
            $data['types'] = Attribute_types::all();
            $data['sets'] = Attribute_set::all();
            $data['attributes'] = Attributes::all();
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

        // Array to replace LT symbols to english
        $unwanted_array = array('Š'=>'s', 'š'=>'s', 'Ž'=>'z', 'ž'=>'z', 'À'=>'a', 'Á'=>'a', 'Â'=>'a', 'Ã'=>'a', 'Ä'=>'a', 'Å'=>'a', 'Æ'=>'a', 'Ç'=>'c', 'È'=>'e', 'É'=>'e',
            'Ê'=>'e', 'Ë'=>'e', 'Ì'=>'i', 'Í'=>'i', 'Î'=>'i', 'Ï'=>'i', 'Ñ'=>'n', 'Ò'=>'o', 'Ó'=>'o', 'Ô'=>'O', 'Õ'=>'o', 'Ö'=>'o', 'Ø'=>'o', 'Ù'=>'u',
            'Ú'=>'u', 'Û'=>'u', 'Ü'=>'u', 'Ý'=>'y', 'Þ'=>'b', 'ß'=>'ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ą'=>'a', 'č'=>'c', 'ę'=>'e', 'ė'=>'e', 'į'=>'i', 'ų'=>'u', 'ū'=>'u',
            'Ą'=>'a', 'Č'=>'c', 'Ę'=>'e', 'Ė'=>'e', 'Į'=>'i', 'Ų'=>'u', 'Ū'=>'u', ' ' => '_');
        $str = $request->name;
        $str = strtr( $str, $unwanted_array );

        $attribute->name = $str;
        $attribute->label = ucfirst($request->name);
        $attribute->type_id = $request->type_id;
        $attribute->save();

        $attribute = Attributes::where('name', $str)->first();
        $set->attribute_set_id = $request->set_id;
        $set->attribute_id = $attribute->id;
        $set->save();

        return redirect()->back();
    }

    public function setAttribute(Request $request)
    {
        $attributes = $request->input('post');
        //dd($attributes);
        foreach ($attributes as $attribute){
            $set = new Attributes_set_relations();
            $set->attribute_set_id = $request->set_id;
            $set->attribute_id = $attribute;
            $set->save();
        }
        return redirect()->back();
    }



}
