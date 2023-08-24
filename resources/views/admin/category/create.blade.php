@extends('layouts.master')

@section('title', 'Category')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4"> Ajouter Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Category</li> 
    </ol>
  
        <div class="card mt-4">
            <div class="card-header">
                <h4>Ajouter Categorie</h4>
            </div>
            <div class="card-body">


            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <div> {{$error}} </div>
                    @endforeach
                </div>
            @endif


                <form action="{{url('admin/add-category');}}" method="POST" enctype="multipart/form-data"> 
                    @csrf

                    <div class="mb-3">
                        <label for="">Nom Categorie :</label>
                        <input type="text" name="nom_cat" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>


                    <div class="mb-3">
                        <button class="btn btn-primary float-end">Ajouter</button>
                    </div>

                </form>
            </div>
        </div>
</div>


@endsection