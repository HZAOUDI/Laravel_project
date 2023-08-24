@extends('Layout.nav1')

@section('title','Edit Annonces')

@section('content')    

    <div class="container">
    <div class="jumbotron">
            
        <div class="row">
           <div class="card mt-4">
            <div class="card-header">
                <h2>Edit Annonces <a class="btn btn-danger" href="{{ url('annonces') }}"> Back </a> </h2> 
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>  
                        @endforeach
                    </div>
                @endif
                
                <form action="{{ url('update-ann/'.$annonce->id) }}"  method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="">Nom</label>
                        <input type="text" name="Nom" value="{{ $annonce->Nom }}" class="form-control"> 
                    </div>

                    
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="Description" rows="3" class="form-control">{{ $annonce->Description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for=""> Categorie </label>
                        <select name="Categorie" class="form-control">
                            <option value="">--Select Caegory--</option>
                            @foreach ($categorie as $catitem)
                                <option value=" {{ $catitem->nom_cat }}" {{ $annonce->Categorie == $catitem->nom_cat ? 'selected' : '' }} >  
                                    {{ $catitem->nom_cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for=""> Objet </label>
                        <select name="Objet" class="form-control">
                            <option value="">--Select Objet--</option>
                            @foreach ($objet as $objitem)
                                <option value=" {{ $objitem->id }}" {{ $annonce->Objet == $objitem->id ? 'selected' : '' }} >  
                                    {{ $objitem->Nom }}
                                </option>
                            @endforeach 
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Prix</label>
                        <input type="text" name="Prix" value=" {{ $annonce->Prix }} " class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Num_jour_min</label>
                        <input type="text" name="Num_jour_min" value="{{ $annonce->Num_jour_min }}" class="form-control">
                    </div>
        

                    <div class="mb-3">
                        <label>Ville</label>
                        <select name="Ville" class="form-control">
                            <option value="tous" {{ $annonce->Ville == 'tous' ? 'selected' : '' }}>Tous</option>
                            <option value="Casablanca" {{ $annonce->Ville == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
                            <option value="Fès" {{ $annonce->Ville == 'Fès' ? 'selected' : '' }}>Fès</option>
                            <option value="Tangier" {{ $annonce->Ville == 'Tangier' ? 'selected' : '' }}>Tangier</option>
                            <option value="Marrakech" {{ $annonce->Ville == 'Marrakech' ? 'selected' : '' }}>Marrakech</option>
                            <option value="Sale" {{ $annonce->Ville == 'Sale' ? 'selected' : '' }}>Sale</option>
                            <option value="Meknès" {{ $annonce->Ville == 'Meknès' ? 'selected' : '' }}>Meknès</option>
                            <option value="Agadir" {{ $annonce->Ville == 'Agadir' ? 'selected' : '' }}>Agadir</option>
                            <option value="Tétouan" {{ $annonce->Ville == 'Tétouan' ? 'selected' : '' }}>Tétouan</option>
                            <option value="Safi"  {{ $annonce->Ville == 'Safi' ? 'selected' : '' }}>Safi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Type</label>
                        <select id="myselection" name="type" class="form-control">
                            <option>Select Option</option>
                            <option value="Normale"  {{ $annonce->type == 'Normale' ? 'selected' : '' }}>Normale</option>
                            <option value="Particuliere" {{ $annonce->type == 'Particuliere' ? 'selected' : '' }}>Particuliere</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="">Date Debut</label>
                        <input type="date" id="" name="date_dispo_debut" value="{{ $annonce->date_dispo_debut }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label  class="">Date Fin</label>
                        <input type="date" id="" name="date_dispo_fin" value="{{ $annonce->date_dispo_fin }}"class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">is_visible</label>
                        <input type="checkbox" name="is_visible" {{ $annonce->is_visible == '1' ? 'checked' : '' }} ">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm"> Modifier </button>
                    </div>

                </form>
            </div>

           </div>
                
            </div>
        </div>
        
    
    
      
    </div>
     
 
@endsection