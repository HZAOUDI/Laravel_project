@extends('Layout.nav1')

@section('title','Objets')

@section('content')    

    <div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right" style="margin-bottom:10px;">
            <a class="btn btn-success" href="/addo"> Create New Objet</a>
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
           
            
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$id }}</td>
            <td><img src="{{ asset('Image/'.$product->image) }}" width="100px"></td>
            <td>{{ $product->Nom }}</td>
            
            
            
            
        </tr>
        @endforeach
    </table>
     
 
@endsection