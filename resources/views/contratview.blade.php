@extends('Layout.nav')

@section('title','Contrat')

@section('content') 

<div class="container">
    
    <div class="jumbotron">
    <div class="container">
        <h2>Consultation Contrat Nº {{$contrat[0]->id }} </h2> <br>

        <form action="">    
            @csrf  
            <h4 class="text-center">Partenaire Informations</h4>
            
            <div style="display: flex; justify-content: center;">
                <img src="{{ asset('picture/' . $user[0]->image) }}" width ="100px" height="100px" alt="partenaire Image" class="" style="border-radius: 50%;">
            </div> <br>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id_partenaire">Nº Partenaire :</label>
                    <input type="text" class="form-control" id="id_partenaire" name="id_partenaire" value="{{$contrat[0]->id_partenaire }}">
                </div>  

                <div class="form-group col-md-6">
                    <label for="nom"> NOM PARTENAIRE: </label>
                    <input type="text" class="form-control" id="nom" name="nom"  value="{{$user[0]->nom }} {{$user[0]->prenom }} ">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email"> EMAIL PARTENAIRE: </label>
                    <input type="email" class="form-control" id="email" name="email"  value="{{$user[0]->email }}"> 
                </div>

                <div class="form-group col-md-6">
                    <label for="adresse"> Adresse PARTENAIRE: </label>
                    <input type="text" class="form-control" id="adresse" name="adresse"  value="{{$user[0]->adresse }}">    
                </div>    
            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telephone"> Téléphone  : </label>
                    <input type="text" class="form-control" id="telephone" name="telephone"  value="{{$user[0]->telephone }}"> 
                </div>
                <div class="form-group col-md-6">
                    <label for="dateNaissance"> dateNaissance </label>
                    <input type="text" class="form-control" id="dateNaissance" name="dateNaissance"  value="{{$user[0]->dateNaissance }}"> 
                </div>
            </div>  
        
            <div style="text-align: center;">
                <h4  >Client Informations</h4>
            </div>

            <div style="display: flex; justify-content: center;">
                <img src="{{ asset('picture/' . $userClient[0]->image) }}" width ="100px" height="100px" alt="partenaire Image" class="" style="border-radius: 50%;">
            </div> <br>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id_client">Nº Client :</label>
                    <input type="text" class="form-control" id="id_client" name="id_client"  value="{{$contrat[0]->id_client }}">
                </div>  

                <div class="form-group col-md-6">
                    <label for="nom2"> NOM Client: </label>
                    <input type="text" class="form-control" id="nom2" name="nom2"  value="{{$userClient[0]->nom }} {{$userClient[0]->prenom }} ">                    
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email2"> EMAIL Client: </label>
                    <input type="email" class="form-control" id="email2" name="email2" value="{{$userClient[0]->email }}"> 
                </div>

                <div class="form-group col-md-6">
                    <label for="adresse2"> Adresse Client: </label>
                    <input type="text" class="form-control" id="adresse2" name="adresse2"  value="{{$userClient[0]->adresse }}">  
                </div> 
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telephone2"> Téléphone Client: </label>
                    <input type="text" class="form-control" id="telephone2" name="telephone2"  value="{{$userClient[0]->telephone }}"> 
                </div>
                <div class="form-group col-md-6">
                    <label for="dateNaissance2"> dateNaissance </label>
                    <input type="text" class="form-control" id="dateNaissance2" name="dateNaissance2"  value="{{$userClient[0]->dateNaissance }}"> 
                </div>
            </div>      
            <br>

            <div style="text-align: center;">
                <h4>Produit Louee Informations</h4>
            </div>
            <div style="display: flex; justify-content: center;">
                <img src="{{ asset('Image/' . $ann[0]->image) }}" width ="100px" height="100px" alt="partenaire Image" class="" style="border-radius: 50%;">
            </div> <br>
        
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id_ann">Nº Annonce:  :</label>
                    <input type="text" class="form-control" id="id_ann" name="id_ann" value="{{$contrat[0]->id_ann }}">
                </div>  

                <div class="form-group col-md-6">
                    <label for="Nom"> NOM: </label>
                    <input type="text" class="form-control" id="Nom" name="Nom" value="{{$ann[0]->Nom}}">                    
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Description">Description: </label>
                    <input type="text" class="form-control" id="Description" name="Description" value="{{$ann[0]->Description }}"> 
                </div>

                <div class="form-group col-md-6">
                    <label for="Categorie">Categorie: </label>
                    <input type="text" class="form-control" id="Categorie" name="Categorie"  value="{{$ann[0]->Categorie }}"> 
                    
                </div> 
                
                <div class="form-group col-md-6">
                    <label for="Marque">Marque : </label>
                    <input type="text" class="form-control" id="Marque" name="Marque"  value="{{$ann[0]->Marque  }}"> 
                </div>

                <div class="form-group col-md-6">
                    <label for="Prix">Prix : </label>
                    <input type="text" class="form-control" id="Prix" name="Prix"  value="{{$ann[0]->Prix }}"> 
                </div>

                <div class="form-group col-md-6">
                    <label for="Ville">Ville : </label>
                    <input type="text" class="form-control" id="Ville" name="Ville"  value="{{$ann[0]->Ville  }}"> 
                </div>

                <div class="form-group col-md-6">
                    <label for="date_dispo_debut">date_dispo_debut : </label>
                    <input type="date" class="form-control" id="date_dispo_debut" name="date_dispo_debut" value="{{$ann[0]->date_dispo_debut  }}"> 
                </div>

                <div class="form-group col-md-6">
                    <label for="">date_dispo_fin : </label>
                    <input type="date" class="form-control" id="date_dispo_fin" name="date_dispo_fin" value="{{$ann[0]->date_dispo_fin  }}"> 
                </div>
    
            </div> <br>

            <button type="submit" class="btn primary-btn cta-btn btn-sm mt-4" id="save_form" style="float:right;">Telecharger pdf</button>

        </form> 

    </div>
    </div>

</div>

<!--<script> 
    $(document).ready(function(){
        $('save_form').on('click', function() {
            const id_partenaire = $ ('#id_partenaire').val();
            const nom = $ ('#nom').val();
            const email = $ ('#email').val();
            const adresse = $ ('#adresse').val();
            const telephone = $ ('#telephone').val();
            const dateNaissance = $ ('#dateNaissance').val();

            const id_client = $ ('#id_client').val();
            const nom2 = $ ('#nom2').val();
            const email2 = $ ('#email2').val();
            const adresse2 = $ ('#adresse2').val();
            const telephone = $ ('#telephone').val();
            const dateNaissance2 = $ ('#dateNaissance2').val();

            const id_ann = $ ('#id_ann').val();
            const Nom = $ ('#Nom').val();
            const Description = $ ('#Description').val();
            const Categorie = $ ('#Categorie').val();
            const Marque = $ ('#Marque').val();
            const Prix = $ ('#Prix').val();
            const Ville = $ ('#Ville').val();
            const date_dispo_debut = $ ('#date_dispo_debut').val();
            const date_dispo_fin = $ ('#date_dispo_fin').val();

            $.ajax({
                type:'POST',
                url: 'save_data',
                data:{
                    '_token': , 
                },
                success:function(data){

                }
            })
        });
    });

</script> -->


@endSection 

