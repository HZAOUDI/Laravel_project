<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\Objet;

class ObjetController extends Controller
{
    public static function index(){
        if (Auth::check()) {
            $id = auth()->user()->id;
            $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.date_fin_loc')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->get(); 
            $categories = Categorie::All();
        }
        else $notifications=NULL;
        return view('addobject')->with(['notifications' => $notifications,'categories'=>$categories]);
    }
    public static function store(Request $request){
        $object = new objet();
        $object->Nom = request('Nom');
        
        $object->Categorie = request('categorie');
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('Image'), $filename);
            $object->image = $filename;
        }
        $object->user_id = auth()->user()->id;
        $object->save();
        return redirect("/");
    }
    public static function consulter(){
        $id = auth()->user()->id;
        $objects = objet::where('user_id',$id)->get();
        $idann = 0;
        if (Auth::check()) {
            $id = auth()->user()->id;
            $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.date_fin_loc')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->get();  
        }
        else $notifications=NULL;
        return view("indexo",['products' => $objects,'id'=>$idann,'notifications'=>$notifications]);
    }



}