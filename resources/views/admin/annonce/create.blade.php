@extends('layouts.master')

@section('title', 'Ajouter Annonce')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Annonces</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Espace admin / Annonces</li>
    </ol>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div> {{$error}} </div>
            @endforeach
        </div>
    @endif

    <div class="card">

        <div class="card-header"> 
            <h2>Ajouter une annonce  </h2>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/add-annonce') }}" method="post" enctype= multipart/form-data>
                @csrf

                <div class="mb-3">
                    <label for="">Image</label>
                    <input type="text" name="image" id=""  class="form-control" >

                </div>

                <div class="mb-3">
                    <label for="">Nom</label>
                    <input type="text" name="Nom" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea type="text" name="Description" class="form-control" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label for="">Marque</label>
                    <input type="text" name="Marque" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">Categorie</label>
                    <select name="Categorie" class="form-control">
                        @foreach ($category as $catitem)
                        <option value="$catitem->id">{{ $catitem->nom_cat }}</option> 
                        @endforeach 
                    </select>
                </div> 

               

                <div class="mb-3">
                    <label for="">Objet</label>
                    <input type="text" name="Objet" class="form-control">
                </div>


                <div class="mb-3">
                    <label for="">Prix</label>
                    <input type="text" name="Prix" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">Ville</label>
                    <input type="text" name="Ville" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">Num_jour_min</label>
                    <input type="number" name="Num_jour_min"  class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">date_dispo_debut</label>
                    <input type="date" name="date_dispo_debut" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">date_dispo_fin</label>
                    <input type="date" name="date_dispo_fin"  class="form-control">
                </div>

                <h4>Status</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="">Status</label>
                            <input type="checkbox" name="status">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end"> Ajouter Annonce</button>
                        </div>
                    </div>
                </div>

            </form>
            
        </div>


    </div>

</div>    

@endsection


