<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;



class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    public function edit($user_id){
        $user = User::find($user_id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $user_id){
        $user = User::find($user_id);
        if($user){   //if user found
            $user->role_as = $request->role_as;
            $user->update();
            return redirect('admin/users')->with('message', 'Updated Successfuly');
        }

        //if user not found
        return redirect('admin/users')->with('message', 'No User Found');
    }


    public function destroy(Request $request){
        $user = User::find($request->user_delete_id);
        if($user){
            $destination ='picture/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $user->delete();

            return redirect('admin/users')->with('message', 'Utilisateur supprimer avec success');

        }else{
            return redirect('admin/users')->with('message', 'No User Found');
        }
    }

}
