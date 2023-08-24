@extends('Layout.nav1')
@section('title','Acceuil')
@section('content')
    <div class="section">
        <!-- container -->
        @if (session('comment_success'))
    <div class="alert alert-success">
        {{ session('comment_success') }}
    </div>
@endif

        <div class="container">
                <h5 class="product-category">Informations sur l'annonceur</h5>
               <div class="product-widget">
									<div class="product-img">
                                     <img src="{{ asset ('picture/' .$user2[0]->image) }}"  alt="photo de l'annonceur" class="w-25"> 

									</div>
                            
									<div class="product-body">
										<h3 class="product-name"><a href="#">{{$user2[0]->nom .' '.$user2[0]->prenom}}</a></h3>
										<h4 class="product-category">nombre d'annonce mise en ligne : {{$nbr}} </h4>
                                        <h4 class="product-price">
                                         <div class="product-rating">
                                          <div class="star-icon">
                                          
                                        @for($i = 1; $i <= $score; $i++)
                                        <i class="fa fa-star"></i>
                                        @endfor
                                        @for($i = 1; $i <= 5-$score; $i++)
                                        <i class="fa fa-star-o"></i>
                                        @endfor
                                    </div>
                                       
                                    </div> </h4>

									</div>
								</div>
   
                <div class="product">
                
                <div class="product-label">
                @if($annonce[0]->type=="particulière")
                    <span class="new"><h4>Annonce particulière</h4></span>
               @endif 
            </div>
                </div>

            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                                    <img src="{{ asset('Image/'.$annonce[0]->image) }}" alt=" Image Produit">
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                                    <img src="{{ asset('Image/'.$annonce[0]->image) }}" alt=" Image Produit">
                        </div>

                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                
                <div class="col-md-5">

             
                    <div class="product-details">
                        <h2 class="product-name">{{$annonce[0]->Nom}}</h2>
                        <div>
                           <div class="product-rating">
                            <div class="star-icon">
                                @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($score_objet))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                                @endfor
                            
                            </div>
                            <br>
                            <p>nbr Review(s) Total : {{ $total_commentaires }}</p>
                            <p>nbr Review(s) object: {{ $total_commentaires_objet }}</p>
                            <p>nbr Review(s) partenaire: {{ $total_commentaires_partenaire }}</p>

    <br>
                            <a class="review-link" href="#">nbr Review(s) </a>
                        </div>
                        <div>
                            <h3 class="product-price">{{$annonce[0]->Prix.' DH/Jour'}}</h3>
                            <span class="product-available">Diponible</span>
                        </div>
                        <p></p>

                        <div class="product-options">
                       
                            <div>
                            
                                <span class="t2" >Catégorie: </span>
                                    <span>{{ $annonce[0]->Categorie }}</span>
							
								</div>
                                
                            <div>
									
                            <span class="t2" >Ville: </span>
                                 {{$annonce[0]->Ville}}
									
								</div>
                                @if ($annonce[0]->type=='Normale')
                                 <div>
                                    <span class="t2" >Le nombre de jour minimal de location:</span>

									  {{$annonce[0]->Num_jour_min}}
									
								</div>
                                <div>
                                    <div>--</div>
                                    <span class="t2" >Disponibilité: </span>
                                    <div>
                                     Du : {{$annonce[0]->date_dispo_debut}}
                                     </br>
                                     Au :  {{$annonce[0]->date_dispo_fin}}
                                    </div>
									
								</div>
                            </div>
                            <div>
                            <form method="POST" action="{{ route('reservations.store') }}">
                                    @csrf()
                                    <input type="hidden" name="annonce_id" value="{{ $annonce[0]->id}}">
                                    <input type="hidden" name="partenaire_id" value="{{ $annonce[0]->user_id}}">
                                    <h5 class="t1" class="choix">Choisissez une période de location:</h5>
                        <div class="form-group">
                        <label class="l1" for="date">Date début :</label>
                        <input class="i1" type="date" id="date_debut_debut_loc" name="date_debut_loc">
                    </div>
                    <div class="form-group">
                        <label class="l1" for="date">Date fin :</label>
                        <input class="i1" type="date" id="date_fin_loc" name="date_fin_loc">
                    </div>
                </div>
                
                <div class="add-to-cart">
                    <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i>Résérver</button>
                </div>
            </form>
            
            
            
            
        </div>
        @endif
        @if($annonce[0]->type=='Particuliere')
    {{-- TO BE CHANGED --}}
    <div>--</div>
            <span class="t2" >Disponibilité: </span>
            <div>
             Du : {{$annonce[0]->date_dispo_debut}}
             </br>
             Au :  {{$annonce[0]->date_dispo_fin}}
            </div>
    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf()
        <input type="hidden" name="annonce_id" value="{{ $annonce[0]->id }}">
        <input type="hidden" name="partenaire_id" value="{{ $annonce[0]->user_id }}">

        <div class="form-group">
            <label class="l1" for="date">Date début :</label>
            <input class="i1" type="date" id="date_debut_loc" name="date_debut_loc">
        </div>

        <div class="form-group">
            <label class="l1" for="date">Date fin :</label>
            <input class="i1" type="date" id="date_fin_loc" name="date_fin_loc">
        </div>

        <label for="">Mois :</label>
        <div>
            @php
            // The binary string representing availability for each month
            $availability = $dispo->month;

            // Convert the binary string to an array of characters
            $availability_array = str_split($availability);

            // Create an array of month names
            $months = [
                "janvier",
                "février",
                "mars",
                "avril",
                "mai",
                "juin",
                "juillet",
                "août",
                "septembre",
                "octobre",
                "novembre",
                "décembre"
            ];
            @endphp

            @foreach($availability_array as $index => $value)
                @if($value == "1")
                    <div class="form-check">
                        <input type="checkbox" class="" name="month[]" value="{{ $months[$index] }}">
                        <label class="form-check-label">{{ ucfirst($months[$index]) }}</label>
                    </div>
                @endif
            @endforeach
        </div>

        <label for="">Jours :</label>
        <div>
            @php
            $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

            $bits = $dispo->disponibilité;

            //$bits = '1100000'; // example string
            @endphp

            @foreach(str_split($bits) as $index => $bit)
                @if($bit == 1)
                    <div>
                        <input type="checkbox" name="jours[]" id="{{ $daysOfWeek[$index] }}" value="{{ $daysOfWeek[$index] }}">
                        <label for="{{ $daysOfWeek[$index] }}">{{ $daysOfWeek[$index] }}</label>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="add-to-cart">
            <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i>Réserver</button>
        </div>
    </form>
@endif
@if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        </ul>
                        
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{$annonce[0]->Description}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->



                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <br>
    <style>
    .avis-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .avis-container img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .avis-container p {
        margin-right: auto;
    }

    .avis-container div {
        display: flex;
        align-items: center;
        margin-left: 100px;
    }

    .avis-container i {
        color: #9c2403;
        margin-right: 5px;
    }

    .clear {
        clear: both;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>À propos de l'objet</h2>
        </div>
    </div>
    <div class="row">
        @foreach ($commentaires as $a)
            <div class="avis-container">
            <a href="/profil{{$a->user_id}}"><img src="{{ asset('picture/'.$a->image) }}" alt=" "></a>
                <p>{{ $a->nom }} : {{ $a->description_objet }}</p>
                <div>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $a->score_objet)
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <div class="clear"></div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="section-title text-center">
            <h2>À propos du partenaire</h2>
        </div>
    </div>
    <div class="row">
        @foreach ($commentaires as $a)
            <div class="avis-container">
                <img src="{{ asset('picture/'.$a->image) }}" alt=" ">
                <p>{{ $a->nom }} : {{ $a->description_user }}</p>
                <div>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $a->score_user)
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <div class="clear"></div>
            </div>
        @endforeach
    </div>
</div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Produit similaire</h3>
                    </div>
                </div>
                    @if (Auth::check()) 
@foreach ($annonceSimilaire as $row) 
                <div class="col-md-3 col-xs-6">
                    <div class="product">
                        <div class="product-img">
                        <img src="{{ asset('Image/'.$row->image) }}" alt=" Image Produit">
                        
                        </div>
                        <div class="product-body">
                            <h3 class="product-categorie"><a href="#">{{$row->Nom}}</a></h3> 
                            <h3 class="product-name"><a href="#">{{$row->Categorie}}</a></h3> 
                            <div class="product-rating">
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
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Section -->



    <!-- jQuery Plugins -->
    
    @endSection

    <script>
    .avis-container {
    background-color: #f9f9f9;
    padding: 10px;
    border: 1px solid #ddd;
}

.nom {
    font-weight: bold;
}

</script>
