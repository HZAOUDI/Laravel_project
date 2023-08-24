@extends('./Layout.nav1')

@section('title','Monprofile')

@section('content')
<div class="container">
    <div class="jumbotron">
   
        <h2>Mon profil : {{$user->nom}} {{$user->prenom}}</h2>
                  
        <form method="post" action=" {{route('users.update-profile') }} "  enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            <div style="display: flex; justify-content: center;">
                <img src="{{ asset ('picture/' .Auth::user()->image) }}"  width ="200px" height="200px"  alt="{{ $user->name }}" style="border-radius: 50%;" class="w-25"> 
            </div> <br><br>

            <div class="form-row">
                <div class="form-group col-md-6"> 
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" value="{{$user->nom}}">
                </div>

                <div class="form-group  col-md-6"> 
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" value="{{$user->prenom}}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group  col-md-6"> 
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                </div>

                <div class="form-group col-md-6"> 
                    <label for="telephone">Telephone</label>
                    <input type="text" class="form-control" name="telephone" id="telephone" value="{{$user->telephone}}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group"> 
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" name="adresse" id="adresse" value="{{$user->adresse}}">
                </div>
            </div>  

            
            <div class="form-group "> 
                <label for="dateNaissance">Date Naissance</label>
                <input type="date" class="form-control" name="dateNaissance" id="dateNaissance" value="{{$user->dateNaissance}}">
            </div>
           
            <div class="form-group "> 
                <label for="password">password</label>
                <input type="password" class="form-control" name="password" id="password" ><br>
            </div>
           

            <!--<div class="form-group"> 
                <input type="file" name="image" class="form-control"> <br>
                <img src="{{ asset ('picture/' .Auth::user()->image) }}"  alt="{{ $user->name }}" style="border-radius: 50%;" class="w-25"> 
            </div>-->

            <button type="submit" class="btn primary-btn cta-btn btn-sm mt-4" style="float:right;">Modifier</button>
        </form>
      
    </div>

</div>

@endSection
