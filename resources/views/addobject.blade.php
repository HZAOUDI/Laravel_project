@extends('Layout.nav1')

@section('title','ajouter object')

@section('content')    

    <div class="container">
    <form action="/object/success" method="POST" enctype="multipart/form-data" class="">
        @csrf
        <div class="">
            <label for="Nom" class="">Nom d'object</label>
            <input type="text" id="Nom" name="Nom" class="form-control">
        </div>
        <div class="mb-4">
            <label for="Categorie" class="">Categorie</label>
            <select id="" name="categorie" class="form-control">
                <option>Select Option</option>
                @foreach($categories as $categorie)
                    <option value="{{$categorie->nom_cat}}">{{$categorie->nom_cat}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="Image" class="">Image</label>
            <input type="file" id="file" name="image" class="form-control" required>
        </div>
        <br>
        <div>
            <button type="submit" class="form-btn primary-btn cta-btn btn-sm mt-4">Ajouter</button>
        </div>
    </form>
    
@endsection

