@extends('Layout.nav1')
<link rel="stylesheet" href="{{ asset('/css/custom.css') }}">

@section('title','avisPartenaire')

@section('content')
<form  class="form" method="POST" action="{{ url('/storeAvisPartenaire') }}">

    @csrf
    <h3>Donnez votre commentaire à propos du client : {{$client[0]->nom}}  {{$client[0]->prenom}}</h3>
   

    <div class="form-group">
        <textarea  name="description" id="name"  required rows="8" cols="80"></textarea>
    </div>
     <div class="rating-css">
        <div class="star-icon">
            @for($i = 1; $i <= 5; $i++)
                <input type="radio" value="{{ $i }}" name="score_user" id="rating{{ $i }}">
                <label for="rating{{ $i }}" class="fa fa-star"></label>
            @endfor
        </div>
    </div>

    <div class="form-group">
    
        <input type="hidden" name="id_profile" id="email" value="{{ Auth::user()->id}}" required>
          {{-- <input type="hidden" name="variable_name" value="valeur_du_champ_hidden"> --}}
    </div>

    <div class="form-group">

        <input type="hidden" name="id_loca" class="form-control" value="{{$location}}" required>

    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

@endSection
