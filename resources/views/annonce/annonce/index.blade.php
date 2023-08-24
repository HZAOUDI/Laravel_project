@extends('Layout.nav1')

@section('title','View Annonces')

@section('content')    

   <div class="container">
            
        @if (session('message'))
            <div class="alert alert-success"> {{ session('message') }} </div>
        @endif

        <h2>Listes Annonces <a class="btn btn-success" href="/add_ann"> Create New Annonce</a> </h2>

        <table class="table table-bordered">
            <thead>
                <th>Nº</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Categorie</th>
                <th>Objet</th>
                <th>Prix</th>
                
                <th>Ville</th>
                <th>type</th>
                <th>date_dispo_debut</th>
                <th>Is visible</th>
                <th>Status</th>
                <th>Afficher</th>
                <th>Modifier</th>
                <th>Supprimer</th>
               
            </thead>
            <tbody>
                @foreach ($annonces as $item)
                <tr>
                    <td>  {{ $item->id }} </td>
                    <td>  {{ $item->Nom }} </td>
                    <td>  {{ $item->Description }} </td>
                    <td>  {{ $item->Categorie }} </td>
                    <td>  {{ $item->Objet }} </td>
                    <td>  {{ $item->Prix }} </td>
                    
                    <td>  {{ $item->Ville }} </td>
                    <td>  {{ $item->type }} </td>
                    <td>  {{ $item->date_dispo_debut }} </td>
                    <td>  {{ $item->is_visible== '1'?'Enligne' :'horsligne' }} </td>
                    <td>  {{ $item->status }} </td>
                    <td>
                        <a href="{{ url('Annonce'.$item->id) }}"  class="btn btn-warning btn-sm">Afficher</a>
                    </td>
                    <td>
                        <a href="{{ url('annonce/'.$item->id) }}"  class="btn btn-success btn-sm">Modifier</a>
                    </td>
                    <td>
                        <a href="{{ url('delete-ann/'.$item->id) }}"  class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        </div>
    
      
 
@endsection