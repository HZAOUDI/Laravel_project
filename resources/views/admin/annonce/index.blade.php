@extends('layouts.master')

@section('title', 'View Annonce')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Annonces</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Espace admin / Annonces</li>
    </ol>
    
    @if (session('message'))
        <div class="alert alert-success"> {{ session('message') }} </div>
    @endif

    <div class="card">

        <div class="card-header"> 
            <h2>Listes des annonces 
            </h2>
        </div>
        <div class="card-body">
            <table id="myDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nº Annonce</th>
                        <th>Nom</th>
                        <th>Categorie</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($annonces as $item)
                    <tr>
                        <td> {{$item->id}} </td>
                        <td> {{$item->Nom}} </td>
                        <td> {{$item->Categorie}} </td>
                        <td>
                            <a href="{{ url('admin/annonce/'.$item->id) }}" class="btn btn-success btn-sm">Modifier</a> 
                        </td>
                        <td>
                            <a href="{{ url('admin/delete-annonce/'.$item->id) }}" class="btn btn-danger btn-sm">Supprimer</a> 
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>

        </div>


    </div>

</div>    

@endsection


