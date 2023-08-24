     
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