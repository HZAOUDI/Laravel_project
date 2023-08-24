@extends('Layout.nav1')

@section('title','Acceuil')

@section('content')

<div class="container">

   <div class="container">
            <!-- row -->
            <div class="row">
                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
									Catégorie :
									<select id="input_select" class="input-select">
                                        <option value="tous">Tous</option>
                                        <option value="Bricolage">Bricolage</option>
										<option value="Electronique">Electronique</option>
										<option value="vehicule">Vehicule</option>
                                        <option value="sport">Sport</option>
									</select>
								</label>

                            <label>
									Ville:
									<select id="input_select2" class="input-select">
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
								</label>
                                prix :
									<select id="input_select3" class="input-select">
                                        <option value="DESC">Plus chère</option>
                                        <option value="ASC">moins chère</option>
                                        </select>
                                 </label>
                                 score :
									<select id="input_select5" class="input-select">
                                        <option value="DESC">mieux noté</option>
                                        <option value="ASC">moins bien noté</option>
                                        </select>
                                 </label>
                        </div>

                    </div>
<div id="search_list">
      
@if (Auth::check()) 
@foreach ($Annonces as $row) 
@if($row->user_id!= Auth::user()->id)
                    <div class="row">
                        <div class="col-md-3 col-xs-5">
                            <div class="product">
                                <div class="product-img">
                            
                                  <img  src="{{ asset('Image/'.$row->image) }}" alt=" Image Produit">
                                    <div class="product-label">
                                    @if($row->type=="particulière")
                                        <span class="new">Annonce particulière</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><a href="#">{{$row->Nom}}</a></h3> 
                                    {{-- <h3 class="product-name"><a href="#">{{$row->nom_obj}}</a></h3> --}}
                                    <h4 class="product-price">{{$row->Prix.' Dh'}}</h4>
                                    <div class="product-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if(isset($scores[$row->id]) && $i <= round($scores[$row->id]))
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        
                                    </div>

                                </div>
                                <div class="add-to-cart">
                                <a href="{{url("/Annonce".$row->id)}}"><button class="add-to-cart-btn"> Consulter</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @else
@foreach ($Annonces as $row) 
                    <div class="row">
                        <div class="col-md-3 col-xs-5">
                            <div class="product">
                                <div class="product-img">
                                  <img src="{{ asset('Image/'.$row->image) }}" alt=" Image Produit">

                                    <div class="product-label">
                                    @if($row->type=="particulière")
                                        <span class="new">Annonce particulière</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><a href="#">{{$row->Nom}}</a></h3> 
                                    {{-- <h3 class="product-name"><a href="#">{{$row->nom_obj}}</a></h3> --}}
                                    <h4 class="product-price">{{$row->Prix.' Dh'}}</h4>
                                    <div class="product-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if(isset($scores[$row->id]) && $i <= round($scores[$row->id]))
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                </div>
                                <div class="add-to-cart">
                                    <a href="{{url("/Annonce".$row->id)}}"><button class="add-to-cart-btn"> Résérver</button>
                                </div>
                            </div>
                        </div>
              @endforeach
              @endif
            </div>

                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>

<div>
        <!-- NEWSLETTER -->
       



</div>

@endSection


      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


      <script>
 
 $(document).ready(function(){
 $('#input_select').on('change',function(){
    var query= $(this).val();
    var query2=$('#input_select2').val();
    var query3=$('#input_select3').val();
    var query4=$('#input_select5').val();
    query=query+','+query2+','+query3+','+query4;
    console.log(query);
     $.ajax({
        url:"/rechercher",
        type:"GET",
        data:{'categorie_ville':query},
        success:function(data){
      $('#search_list').html(data);

        }
 });
});
});
 $(document).ready(function(){
 $('#input_select2').on('change',function(){
    var query= $(this).val();
    console.log(query);

    var query2=$('#input_select').val();
    var query3=$('#input_select3').val();
    var query4=$('#input_select5').val();
    query=query2+','+query+','+query3+','+query4;
            console.log(query);

     $.ajax({
        url:"/rechercher",
        type:"GET",
        data:{'categorie_ville':query},
        success:function(data){
      $('#search_list').html(data);

        }
 });
});
});

  $(document).ready(function(){
 $('#input_select3').on('change',function(){
    var query= $(this).val();
    var query2=$('#input_select').val();
    var query3=$('#input_select2').val();
    var query4=$('#input_select5').val();
    query=query2+','+query3+','+query+','+query4;
                  console.log(query);

     $.ajax({
        url:"/rechercher",
        type:"GET",
        data:{'categorie_ville':query},
        success:function(data){
      $('#search_list').html(data);

        }
 });
});
});

$(document).ready(function(){
 $('#input_select5').on('change',function(){
    var query= $(this).val();
    console.log(query);

    var query2=$('#input_select').val();
    var query3=$('#input_select2').val();
    var query4=$('#input_select3').val();
    query=query2+','+query3+','+query+','+query4;
            console.log(query);

     $.ajax({
        url:"/rechercher",
        type:"GET",
        data:{'categorie_ville':query},
        success:function(data){
      $('#search_list').html(data);

        }
 });
});
});
   $(document).ready(function(){
 $('#search').on('keyup',function(){
 var query4=$('#nom_obj').val();
 console.log(query4)
        $.ajax({
        url:"/rechercher",
        type:"GET",
        data:{'nomObjet':query4},
        success:function(data){
    //  $('#search_list').html(data);

        }
 });
});
});


</script>
