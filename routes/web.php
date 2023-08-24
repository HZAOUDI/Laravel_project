<?php

use App\Models\Notification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ObjetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\CommentaireController;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Users;
use App\Http\Requests\Users\UpdateProfileRequest;

use App\Http\Requests\Admin\CategoryFormRequest;


Route::get('/', [App\Http\Controllers\AnnonceController::class, 'index'])->name('index');
//Route::get('/create', [App\Http\Controllers\AnnonceController::class, 'create'])->name('create');
Route::post('/store', [App\Http\Controllers\AnnonceController::class, 'store'])->name('store');

Route::get('/edit/{product}', [App\Http\Controllers\AnnonceController::class, 'editAnnonce'])->name('edit');
Route::put('/edit/{product}', [App\Http\Controllers\AnnonceController::class, 'update'])->name('update');
Route::delete('/{product}', [App\Http\Controllers\AnnonceController::class, 'destroy'])->name('destroy');

//added by me
Route::get('annonces',[App\Http\Controllers\Annonce\AnnonceController::class,'index']);
Route::get('add-ann',[App\Http\Controllers\Annonce\AnnonceController::class,'create']);
Route::post('add-ann',[App\Http\Controllers\Annonce\AnnonceController::class,'store']);
Route::get('annonce/{annonce_id}', [App\Http\Controllers\Annonce\AnnonceController::class,'edit']); 
Route::put('update-ann/{annonce_id}', [App\Http\Controllers\Annonce\AnnonceController::class,'update']);
Route::get('delete-ann/{annonce_id}', [App\Http\Controllers\Annonce\AnnonceController::class,'destroy']);


Route::get('/',[AnnonceController::class,'AfficherAnnonce']);
Route::get('/test/h',[AnnonceController::class,'AfficherAnnonce']);
Route::get('/Annonce{id}',[AnnonceController::class,'AfficherUneAnnonce']);
Route::get('/rechercher',[AnnonceController::class,'search']);
Route::get('/notifications', function () {
    if (Auth::check()) {
        $id = auth()->user()->id;
        $notifications = DB::table('notifications')
        ->select('notifications.*', '_locations.id')
        ->join('_locations','_locations.id','=','notifications.id_loca')
        ->where('notifications.id_user', '=', $id)
        ->where('notifications.lue', '=', "non")
        
        ->whereRaw('DATEDIFF(NOW(), _locations.date_fin_loc) <= 7')
        ->whereRaw('DATEDIFF(NOW(), _locations.date_fin_loc) >= 0')
        ->orderBy('notifications.created_at')
        ->get(); 
        $notifications1 = DB::table('notifications')
        ->where('notifications.id_user', '=', $id)
        ->where('notifications.lue', '=', "non")
        ->where('type' ,'=', '1')->get();
        $count= count($notifications)+count($notifications1);
        
    }
    else {$notifications=NULL;
        $count=0;
    }
    return response()->json(['notifications' => $notifications,'count'=>$count,'notifications1'=>$notifications1]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Route::get('/', function () {
    return view('welcome');
});  */


Route::get('profile', [UserController::class,'edit'] )->name('users.edit-profile');
Route::put('profile', [UserController::class,'update'])->name('users.update-profile');

Route::get('/contratsview', [UserController::class,'viewform']);
Route::get('/contratsview', [UserController::class,'index'])->name('contrats-view');

Route::get('/click_edit_{id}', [UserController::class,'view_function']); 

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class,'index'])->name('add.category');

    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class,'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoryController::class,'store']);

    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class,'edit']); 
    Route::put('update-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class,'update']); 
    //Route::get('delete-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class,'destroy']);
    Route::post('delete-category', [App\Http\Controllers\Admin\CategoryController::class,'destroy']);

    Route::get('annonces', [App\Http\Controllers\Admin\AnnonceController::class, 'index']) ; 
    Route::get('add-annonce', [App\Http\Controllers\Admin\AnnonceController::class, 'create']) ; 
    Route::post('add-annonce', [App\Http\Controllers\Admin\AnnonceController::class, 'store']) ; 
    Route::get('annonce/{annonce_id}', [App\Http\Controllers\Admin\AnnonceController::class, 'edit']);  
    Route::put('update-annonce/{annonce_id}', [App\Http\Controllers\Admin\AnnonceController::class, 'update']);
    Route::get('delete-annonce/{annonce_id}', [App\Http\Controllers\Admin\AnnonceController::class, 'destroy']);

    
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'edit']); 
    Route::put('update-user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'update']); 
    Route::post('delete-user',  [App\Http\Controllers\Admin\UserController::class, 'destroy']); 

    //Route::POST('add-category', [App\Http\Controllers\Admin\CategoryController::class,'addcategory'])->name('add.category');

});


Route::get('/add_ann',[AnnonceController::class,'index'])->name('add')->middleware(['auth', 'verified']);
Route::get('addo',[ObjetController::class,'index'])->middleware(['auth', 'verified']);
Route::get('/profil{id}',[AvisController::class,'ProfilClient']);
Route::POST('/object/success',[ObjetController::class,'store']);
Route::POST('/success',[AnnonceController::class,'store']);
Route::GET('/successs_{notif}', function(){
    $id = auth()->user()->id;
    $notifications = Notification::where('notifications.id_user', '=', $id)
    ->where('notifications.lue', '=', "non")
    ->where('type' ,'=', '1')->first();
    $notifications->update(['lue' => 'oui']);
    
    return redirect('https://www.gmail.com');

});
Route::get('/edit/{annonce}', [AnnonceController::class, 'edit'])->name('edit')->middleware(['auth', 'verified']);
Route::put('/edit/{annonce}', [AnnonceController::class, 'update2'])->name('update');
Route::get('/annonce/{annonce}',[AnnonceController::class,'show'])->name('show');
Route::get('/consulter',[AnnonceController::class,'consulter']);

Route::get('/test',function(){
        return view('add2');
    })->middleware(['auth', 'verified']);
Route::get('/email',[AnnonceController::class,'Sendmail']);
Route::get('/consulter_objects',[ObjetController::class,'consulter'])->middleware(['auth', 'verified']);
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/demandes-de-reservation', [LocationController::class,'demandesDeReservation'])->name('locations.demandes-de-reservation');
Route::post('/locations/{id}/confirm', [LocationController::class, 'confirm'])->name('locations.confirm');
Route::post('/locations/{id}/refuse', [LocationController::class, 'refuse'])->name('locations.refuse');

Route::get('/avisPartenaire/{id_loca}',[AvisController::class,'addComment']);
Route::post('/storeAvisPartenaire', [AvisController::class,'store']);
Route::get('/commentaire/{id_loca}', [CommentaireController::class, 'formcon'])->name('formcon');
Route::post('/commentaire/{id_loca}', [CommentaireController::class, 'formcreate'])->name('formcreate');
