@extends('layouts.master')

@section('title', 'Category')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4"> Modifier Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Category</li> 
    </ol>
  
        <div class="card mt-4">
            <div class="card-header">
                <h4>Ajouter Categorie
                    <a href="{{ url('admin/category') }}" class="btn btn-danger float-end"> Retour </a> 
                </h4>
            </div>

            <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <div> {{$error}} </div>
                    @endforeach
                </div>
            @endif


                <form action="{{ url('admin/update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')


                    <div class="text-center mb-3"> 
                        <img src="{{ asset('picture/category/'.$category->image) }}" class="rounded" width="350px" height="200px" alt="Img" >             
                    </div>

                    <div class="mb-3">
                        <label for="">Nom Categorie :</label>
                        <input type="text" name="nom_cat" value="{{ $category->nom_cat }}" class="form-control"> 
                    </div>

                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>


                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end"> Modifier </button>
                    </div>

                </form>
            </div>
        </div>
</div>


@endsection