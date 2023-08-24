@extends('layouts.master')

@section('title', 'Category')

@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

        <form action="{{ url('admin/delete-category') }}" method="post"> 
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer Categorie</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="category_delete_id" id="category_id">
                <h5>Est ce que vous etes sur de la suppression du categorie?</h5>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
            </div>
        </form>

    </div>
  </div>
</div>

<div class="container-fluid px-4">
    <h1 class="mt-4">Categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Espace admin / Category</li>
    </ol>
    
    @if (session('message'))
        <div class="alert alert-success"> {{ session('message') }} </div>
    @endif

    <div class="card">

        <div class="card-header"> 
            <h2>Listes des categories 
                <a href="{{ url('admin/add-category')}}" class="btn btn-primary float-end">Ajouter</a> </h2>
            
        </div>

        <div class="card-body">

            <table id="myDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Image</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                        <tr>
                            <td> {{$item->id}} </td>
                            <td> {{$item->nom_cat}} </td>
                            <td>   
                                <img src="{{ asset('picture/category/'.$item->image) }}" alt="Img" width="80px" height="50px"> 
                            </td>
                            
                            <td> <a href=" {{ url('admin/edit-category/'.$item->id) }}" class="btn btn-success btn-sm">Modifier</a></td> 
                            <td>
                                <!--<a href=" {{ url('admin/delete-category/'.$item->id) }}" class="btn btn-danger">Delete</a> -->
                                <button type="button" class="btn btn-danger deleteCategoryBtn btn-sm" value="{{ $item->id }}"> Supprimer </button> 
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
           
                $(document).on('click', '.deleteCategoryBtn', function(e){

                
                e.preventDefault();

                var category_id = $(this).val();
                $('#category_id').val(category_id);
                $('#deleteModal').modal('show');

            });
        });
    </script>

@endsection
