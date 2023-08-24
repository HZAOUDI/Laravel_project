@extends('layouts.master')

@section('title', 'Users edit')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Utilisateurs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Espace admin / Modifier utilisateur</li>
    </ol>
  

    <div class="card">

        <div class="card-header"> 
            <h2>Modifier utilisateur 
                <a href="{{ url('admin/users') }}" class="btn btn-danger float-end"> Retour </a> 
            </h2>           
        </div>

        <div class="card-body">
            <div class="text-center"> 
                <img src="{{ asset('picture/'.$user->image) }}" class="rounded-circle" width="200" alt="Img" >             
            </div>

            <div class="mb-3">
                <label for="">Nom:</label>
                <p class="form-control"> {{$user->nom}} </p> 
            </div>

            <div class="mb-3">
                <label for="">Prenom:</label>
                <p class="form-control"> {{$user->prenom}} </p> 
            </div>

            <div class="mb-3">
                <label for="">Email:</label>
                <p class="form-control"> {{$user->email}} </p> 
            </div>

            <div class="mb-3">
                <label for="">Telephone:</label>
                <p class="form-control"> {{$user->telephone}} </p> 
            </div>

            <div class="mb-3">
                <label for="">Adresse:</label>
                <p class="form-control"> {{$user->adresse}} </p> 
            </div>

            <div class="mb-3">
                <label for="">Created At:</label>
                <p class="form-control"> {{$user->created_at}} </p> 
            </div>

            <form action="{{ url('admin/update-user/'.$user->id) }}" method="post"> 
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">Role_as</label>

                    <select name="role_as" id="" class="form-control">
                        <option value="1" {{ $user->role_as == '1' ? 'selected': ''}} >Admin</option>
                        <option value="0" {{ $user->role_as == '0' ? 'selected': ''}} >Utilisateur</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type ="submit" class="btn btn-primary">Modifier le role</button>
                </div>

            </form>


        </div>
    </div>
</div>

@endsection
