@extends('layouts.master')

@section('title', 'Users view')

@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

        <form action="{{ url('admin/delete-user') }}" method="post"> 
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer Utilisateur</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_delete_id" id="user_id">
                <h5>Est ce que vous etes sur de la suppression du cet Utilisateur ?</h5>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
            </div>
        </form>

    </div>
  </div>
</div>

<div class="container-fluid px-4">
    <h1 class="mt-4">Utilisateurs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Espace admin / Consulter utilisateurs</li>
    </ol>
    
    @if (session('message'))
        <div class="alert alert-success"> {{ session('message') }} </div>
    @endif

    <div class="card">

        <div class="card-header"> 
            <h2>Listes des Utilisateurs </h2>          
        </div>

        <div class="card-body">

            <table id="myDataTable" class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Supprimer</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td> {{$item->id}} </td>
                            <td> {{$item->nom}} </td>
                            <td> {{$item->prenom}} </td>
                            <td>   
                                <img src="{{ asset('picture/'.$item->image) }}" alt="Img" width="70px" height="50px"> 
                            </td>

                            <td> {{$item->email}} </td>
                            <td> {{$item->telephone}} </td>

                            <td> {{$item->role_as == '1' ? 'Admin' : 'User' }} </td>

                            <td> <a href=" {{ url('admin/user/'.$item->id) }}" class="btn btn-success btn-sm">Modifier</a></td> 
                            <td> 
                                <button type="button" class="btn btn-danger btn-sm deleteUserBtn" value="{{ $item->id }}"> Supprimer </button>  
                            </td>
                        
                        </tr>
                    @endforeach

                </tbody>
            </table>            

        </div>
    </div>

</div>


@endsection

@section('scripts')  
    <script>
        $(document).ready(function()  {
           
           $(document).on('click', '.deleteUserBtn', function(e){
   
            e.preventDefault();

            var user_id = $(this).val();
            $('#user_id').val(user_id);
            $('#deleteModal').modal('show');

            });
        });
    </script>
@endsection