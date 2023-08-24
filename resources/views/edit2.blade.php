@extends('./Layout.nav1')

@section('title','Monprofile')


@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Mon profil</h4>
                </div>
                <div class="card-body ">
                    <form method="post" action=" {{route('users.update-profile') }} "  enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            
                            <div class="form-group"> 
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" name="nom" id="nom" value="{{$user->nom}}">
                            </div>

                            <div class="form-group"> 
                                <label for="prenom">Prenom</label>
                                <input type="text" class="form-control" name="prenom" id="prenom" value="{{$user->prenom}}">
                            </div>

                            <div class="form-group"> 
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                            </div>

                            <div class="form-group"> 
                                <label for="telephone">Telephone</label>
                                <input type="text" class="form-control" name="telephone" id="telephone" value="{{$user->telephone}}">
                            </div>

                            <div class="form-group"> 
                                <label for="adresse">Adresse</label>
                                <input type="text" class="form-control" name="adresse" id="adresse" value="{{$user->adresse}}">
                            </div>

                            <div class="form-group"> 
                                <label for="dateNaissance">Date Naissance</label>
                                <input type="date" class="form-control" name="dateNaissance" id="dateNaissance" value="{{$user->dateNaissance}}">
                            </div>

                            <div class="form-group"> 
                                <label for="password">password</label>
                                <input type="password" class="form-control" name="password" id="password" ><br>
                            </div>

                            <div class="form-group"> 
                                <input type="file" name="image" class="form-control"> <br>
                                <img src="{{ asset ('picture/' .Auth::user()->image) }}"  alt="{{ $user->name }}" class="w-25"> 
                            </div>

                            <button type="submit" class="btn btn-success">Modifier</button>
                    </form>

                </div>
            </div>
            

            

        </div>
            

       
    </div>
</div>

@endSection
