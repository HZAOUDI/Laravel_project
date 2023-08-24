<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;

use Illuminate\Support\Facades\File;
use App\Models\User;

use App\Http\Requests\Admin\CategoryFormRequest;


class CategoryController extends Controller
{
    public function index(){
        $category = Categorie::all();
        return view('admin.category.index', compact('category'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request){
        $data = $request->validated();
        $category = new Categorie;

        $category->nom_cat	= $data['nom_cat'];
        
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('picture/category/', $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('admin/category')->with('message', 'Categorie added successfuly');

    }

    public function edit($category_id){
        $category = Categorie::find($category_id);
        return view ('admin.category.edit', compact('category') );

    }

    public function update(CategoryFormRequest $request, $category_id){
        $data = $request->validated();

        $category =  Categorie::find($category_id);

        $category->nom_cat	= $data['nom_cat'];

        if($request->hasfile('image')){
            $destination = 'picture/category/'.$category->image;

            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('picture/category/', $filename);
            $category->image = $filename;
        }


        $category->update();
        return redirect('admin/category')->with('message', 'Categorie uppdated successfuly');
    }

    public function destroy(Request $request){
        $category = Categorie::find($request->category_delete_id);
        if($category){

            $category->delete();
            return redirect('admin/category')->with('message', 'Categorie deleted successfuly');

        }else{
            return redirect('admin/category')->with('message', 'No Categorie ID found');

        }

    }

    /*public function addcategory (Request $request ){
        $request ->validate([
            'nom_cat'=> 'required|unique:index',
        ],
        [
            'nom_cat.required'=> 'Name is required', 
            'nom_cat.unique'=> 'Category existe deja',   
  
        ]
    );
    } */


}
