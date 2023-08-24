@extends('Layout.nav1')

@section('title','Add Annonces')

@section('content')    

    <div class="container">
    <div class="jumbotron">
            
        <div class="row">
           <div class="card mt-4">
            <div class="card-header">
                <h2>Add Annonces <a class="btn btn-success" href="/add_ann"> Create New Annonce</a> </h2>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>  
                        @endforeach
                    </div>
                @endif
                
                <form action="{{ url('add-ann') }}"  method='post'>
                    @csrf

                    <div class="mb-3">
                        <label for="">Nom</label>
                        <input type="text" name="Nom" class="form-control">
                    </div>

                    
                    <div class="mb-3">
                        <label for="">Description</label>
                        <input type="text" name="Description" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for=""> Categorie </label>
                        <select name="Categorie" class="form-control">
                            @foreach ($categorie as $catitem)
                                <option value=" {{ $catitem->nom_cat }} "> {{ $catitem->nom_cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for=""> Objet </label>
                        <select name="Objet" class="form-control">
                            @foreach ($objet as $objitem)
                                <option value=" {{ $objitem->Nom }} "> {{ $objitem->Nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Prix</label>
                        <input type="text" name="Prix" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Num_jour_min</label>
                        <input type="text" name="Num_jour_min" class="form-control">
                    </div>
        

                    <div class="mb-3">
                        <label>Ville</label>
                        <select name="Ville" class="form-control">
                            <option value="tous">Tous</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Fès">Fès</option>
                            <option value="Tangier">Tangier</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="Sale">Sale</option>
                            <option value="Meknès">Meknès</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Tétouan">Tétouan</option>
                            <option value="Safi">Safi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Type</label>
                        <select id="myselection" name="type" class="form-control">
                            <option>Select Option</option>
                            <option value="Normale">Normale</option>
                            <option value="Particuliere">Particuliere</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="">Date Debut</label>
                        <input type="date" id="" name="date_dispo_debut" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label  class="">Date Fin</label>
                        <input type="date" id="" name="date_dispo_fin" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">is_visible</label>
                        <input type="checkbox" name="is_visible" >
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"> Save</button>
                    </div>

                </form>
            </div>

           </div>
                
            </div>
        </div>
        
    
    
      
    </div>
     
 
@endsection