
@extends('Layout.nav1')

@section('title','ajouter object')

@section('content')    

    <div class="container">
    <style>
        .myDiv{
            display:none;
            padding:10px;
            margin-top:20px;
        }  
        #showOne{
            border:1px solid red;
        }
        #showNormale{
            border:1px solid green;
        }
        #showParticuliere{
            border:1px solid blue;
        }
        </style> 
    <form action="/success" method="POST" enctype="multipart/form-data" class="">
        @csrf
        <div class="mb-4">
            {{-- //a5 --}}
            @if(session('message'))
    <div class="text-danger">
        {{ session('message') }}
    </div>
@endif

            <label for="Nom" class="block text-gray-700 font-bold mb-2">Titre d'annonce</label>
            <input type="text" id="Nom" name="Nom" class="form-control">
        </div>
        <div class="mb-4">
            <label for="Description" class="f">Object</label>
           <select name="objet" id="annonce-type" class="form-control">
            @foreach ($objets as $objet)
            <option value="{{$objet->id}}">{{$objet->Nom}}</option>
            @endforeach
           </select>
        </div>
        <div class="mb-4">
            <label for="Description" class="">Description</label>
            <input type="text" id="Description" name="Description" class="form-control">
        </div>
        <div class="mb-4">
            <label for="Prix" class="">Prix</label>
            <input type="text" id="Prix" name="Prix" class="form-control">
        </div>
        
        <div class="mb-4">
            <label for="Ville" class="">Ville</label>
            <select id="input_select2" class="form-control" name="Ville">
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
        <label for="Ville" class="">Type</label>
        <select id="myselection" name="type" class="form-control">
            <option>Select Option</option>
            <option value="Normale">Normale</option>
            <option value="Particuliere">Particuliere</option>
        </select>
        <br>

        <div id="showNormale" class="myDiv">
            
            <div class="mb-4">
                <label for="Categorie" class="">Nombre du Jours Minimum</label>
                <input type="text" id="Categorie" name="Num_jour_min" class="form-control">
            </div>
            <div class="mb-4">
                <label for="Categorie" class="">Date Debut</label>
                <input type="date" id="" name="date_dispo_debut" class="form-control">
            </div>
            <div class="mb-4">
                <label for="Categorie" class="">Date Fin</label>
                <input type="date" id="" name="date_dispo_fin" class="form-control">
            </div>
        </div>
        <div id="showParticuliere" class="myDiv">
            <div class="mb-4">
                <div class="mb-4">
                    <label for="Categorie" class="">Date Debut</label>
                    <input type="date" id="" name="date_dispo_debut2" class="form-control">
                </div>
                <div class="mb-4">
                    <label for="Categorie" class="">Date Fin</label>
                    <input type="date" id="" name="date_dispo_fin2" class="form-control">
                </div>
                <label class="">
                    disponibilite :
                </label>
                <div class="form-check">
                    <input type="checkbox" class="" name="disponibilite[]" value="monday">
                    <label class="form-check-label">Lundi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="" name="disponibilite[]" value="tuesday">
                    <label class="form-check-label">Mardi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="" name="disponibilite[]" value="wednesday">
                    <label class="form-check-label">Mercredi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="" name="disponibilite[]" value="thursday">
                    <label class="form-check-label">Jeudi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="" name="disponibilite[]" value="friday">
                    <label class="form-check-label">Vendredi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="" name="disponibilite[]" value="saturday">
                    <label class="form-check-label">Samedi</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="" name="disponibilite[]" value="sunday">
                    <label class="form-check-label">Demanche</label>
                </div>
                <label class="">Mois :</label>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="janvier">
  <label class="form-check-label">Janvier</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="février">
  <label class="form-check-label">Février</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="mars">
  <label class="form-check-label">Mars</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="avril">
  <label class="form-check-label">Avril</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="mai">
  <label class="form-check-label">Mai</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="juin">
  <label class="form-check-label">Juin</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="juillet">
  <label class="form-check-label">Juillet</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="août">
  <label class="form-check-label">Août</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="septembre">
  <label class="form-check-label">Septembre</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="octobre">
  <label class="form-check-label">Octobre</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="novembre">
  <label class="form-check-label">Novembre</label>
</div>
<div class="form-check">
  <input type="checkbox" class="" name="month[]" value="décembre">
  <label class="form-check-label">Décembre</label>
</div>

            </div>
        </div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>      

<script>
$(document).ready(function(){
    $('#myselection').on('change', function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
</script> 
<br>
        <div>
            <button type="submit" class="btn primary-btn cta-btn btn-sm mt-4">Ajouter</button>
        </div>
        
    </form>
@endsection