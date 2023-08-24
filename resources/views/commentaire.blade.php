
@extends('Layout.nav1')
@section('content')

<link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
<form method="POST" action="{{ route('formcreate', $id_loca) }}">
    
    @csrf
    <input type="hidden" name="id_loca" value="{{ $id_loca }}">
    <div class="form-group">
        <label for="commentaire">Ecrivez votre commentaire sur l'objet</label>
        
        <textarea name="description_objet" class="form-control" placeholder="Saisissez votre commentaire sur l'objet ici" required></textarea>
    </div>
    <div class="form-group">
        <label for="commentaire">Ecrivez votre commentaire sur le partenaire</label>
        
        <textarea name="description_user" class="form-control" placeholder="Saisissez votre commentaire sur le partenaire ici" required></textarea>
    </div>
    <div class="rating-css">
    <style>
      .star1-icon, .star2-icon {
display: inline-block;
vertical-align: middle;
margin-right: 10px;
}
    .translation{
      display: inline-block;
      margin-right: 130px;
      vertical-align: 20px;
    }
    .trans{
      display: inline-block;
      margin-right: 50px;
      vertical-align: 20px;
    }
    .star-icon {
      display: inline-block;
    }
  </style>
        <label for="commentaire" class="translation">Etat de l'objet:</label>
<div class="star1-icon">
    @for($i = 1; $i <= 5; $i++)
        <input type="radio" value="{{ $i }}" name="product_rating" id="product_rating{{ $i }}">
        <label for="product_rating{{ $i }}" class="fa fa-star"></label>
    @endfor
</div>


    <br>
<label for="commentaire" class="trans">Sympathie du partenaire:</label>
<div class="star2-icon">
    @for($i = 1; $i <= 5; $i++)
        <input type="radio" value="{{ $i }}" name="part_rating" id="part_rating{{ $i }}">
        <label for="part_rating{{ $i }}" class="fa fa-star"></label>
    @endfor
</div>
<br>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

</div>
@if(session('success'))
<div class=" alert-success">
{{session('success')}}
</div>
@endif
@endsection