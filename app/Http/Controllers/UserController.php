<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Http\Requests\Users\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;


use App\Models\User;

class UserController extends Controller
{
    public function edit(){
        if (Auth::check()) {
            $id = auth()->user()->id;
            $notifications = DB::table('notifications')
            ->select('notifications.*','_locations.date_fin_loc')
            ->join('_locations','_locations.id','=','notifications.id_loca')
            ->where('notifications.id_user', '=', $id)
            ->get();  
        }
        else $notifications=NULL;
        return view('users.edit')->with(['user'=> auth()->user(),'notifications'=>$notifications]);

    }

    public function update(UpdateProfileRequest $request)
{
    $user = auth()->user();
    $data = [
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
        'dateNaissance' => $request->dateNaissance,
    ];

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $destination = public_path('picture/') . $user->image;
        if(File::exists($destination)) {
            File::delete($destination);
        }
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('picture/'), $filename);
        $data['image'] = $filename;
    }

    if (!empty($request->password)) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->back()->with('success', 'Profile mis à jour avec succès.');
}

public function viewform (){
    if (Auth::check()) {
        $id = auth()->user()->id;
        $notifications = DB::table('notifications')
        ->select('notifications.*','_locations.date_fin_loc')
        ->join('_locations','_locations.id','=','notifications.id_loca')
        ->where('notifications.id_user', '=', $id)
        ->get();  
    }
    else $notifications=NULL;
    return view('contratsview')->with(['notifications'=>$notifications]); 
}
public function index(){
    if (Auth::check()) {
        $id = auth()->user()->id;
        $notifications = DB::table('notifications')
        ->select('notifications.*','_locations.date_fin_loc')
        ->join('_locations','_locations.id','=','notifications.id_loca')
        ->where('notifications.id_user', '=', $id)
        ->get();  
    }
    else $notifications=NULL;
    $userId = Auth::id();

    // Retrieve data from "_contrats" table where "id_partenaire" or "id_client" matches the user ID
    $contrat = DB::table('_contrats')
                ->where('id_partenaire', $userId)
                ->orWhere('id_client', $userId)
                ->get();

    // Pass the retrieved data to a view named "contratsview"
    return view('contratsview', ['contrat' => $contrat,'notifications'=>$notifications]);

   // $contrat = DB::select('select * FROM _contrats');
    //return view('contratsview', ['contrat'=>$contrat]);
}
 

/*public function fetchcontrat(){
    $contrats = Contrat::all();
    return response()->json([
        'contrats'=> $contrats,
    ]);
}
*/       

    /*public function view_function($id){
        $contrat = DB::select ('select * from _contrats where id=?', [$id] );
        return view('contratview', ['contrat'=> $contrat] );
    }*/

    public function view_function($id){
      
        $contrat = DB::select ('select * from _contrats where id=?', [$id] );
    
        // Check if the $contrat array is not empty
        if (!empty($contrat)) {
            // Retrieve User data with the ID equal to $contrat[0]->id
            $user = DB::select ('select * from users where id=?', [$contrat[0]->id_partenaire]);

            // Retrieve User data with the ID equal to $contrat[0]->id_client
            $userClient = DB::select ('select * from users where id=?', [$contrat[0]->id_client]);

            $ann = DB::select ('select * from annonces where id=?', [$contrat[0]->id_ann] );

            return view('contratview', ['contrat'=> $contrat, 'user' => $user, 'userClient' => $userClient, 'ann'=>$ann]);
        } else {
            // Handle the case where $contrat array is empty, e.g. show an error message or redirect to an appropriate page
            return redirect()->back()->with('error', 'Contrat not found.');
        }

    }
    

}