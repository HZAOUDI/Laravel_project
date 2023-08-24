@extends('Layout.nav1')

@section('title','Annonces')

@section('content')    

    <div class="container">
    <div class="jumbotron">
            
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2></h2>
                </div>
                <div class="pull-right" style="margin-bottom:10px;">
                <a class="btn btn-success" href="/add_ann"> Create New Annonce</a>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    
        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Categorie</th>
                <!--<th>Objet</th>-->
                <th>Prix</th>
                <th>N_MinLoc</th>
                <th>Ville</th>
                <th>Date Disponibilite</th>
                
                <!--<th>Status</th>-->
                <th>Type</th>
                <th>Is_visible</th>
            <!-- <th>User_id</th> -->
                <th width="280px">Action</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ ++$id }}</td>
                <td><img src="{{ asset('Image/'.$product->image) }}" width="100px"></td>
                <td>{{ $product->Nom }}</td>
                
                <td>{{ $product->Description }}</td>
                <td>{{ $product-> Categorie}}</td>
                <!--<td>{{ $product-> Objet}}</td>-->
                <td>{{ $product-> Prix}}</td>
                <td>{{ $product-> Num_jour_min}}</td>
                <td>{{ $product-> Ville}}</td>
                <td> De: {{ $product-> date_dispo_debut}} <br> A {{ $product-> date_dispo_fin}} </td>
                
                <!--<td>{{ $product-> status}}</td>-->
                <td>{{ $product-> type}}</td>
                <td> @if ($product->is_visible == 'en ligne')
            <a class="btn btn-secondary">{{ $product->is_visible }}</a>
        @else
            <a  class="btn btn-warning">{{ $product->is_visible }}</a>
        @endif </td>
                
                <!--<td>{{ $product-> user_id}}</td> -->
                
                
                <td>
                    <form action="{{ route('destroy',$product->id) }}" method="POST">
        
                        <a class="btn btn-info btn-sm" href="{{ route('show',$product->id) }}">Show</a>
        
                        <a class="btn btn-primary btn-sm" href="{{ route('edit',$product->id) }}">Edit</a>
        
                        @csrf
                        @method('DELETE')
            
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
     
 
@endsection