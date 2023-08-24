 
    @extends('Layout.nav1')
    @section('title','Acceuil')

@section('content')

    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container mt-5">

            <div class="row  d-flex justify-content-center">
  

<div class="profile">
  <img src="{{ asset('picture/'.$client->image) }}" alt="" >
  <h2>{{$client->nom ." " . $client->prenom}}</h2>
</div>
    <div class="bg-light p-4 d-flex justify-content-end text-left">
                <ul class="list-inline mb-0">
                    
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">{{count($partenaire)}}<small class="text-muted"> <i class="fa fa-user-circle-o mr-1"></i>commentaires</small></h5>
                    </li>
                </ul>
            </div>
    

@foreach ($partenaire as $row )
          <div class="comment">

  <h3>  <img src="{{ asset ('picture/' .$row->image) }}" alt="" class="rounded-circle" style="width: 60px;">: {{$row->description_user}}</small>  </h3>
  <div class="star-icon">

                       @for($i = 1; $i <= $row->score_user; $i++)
                                        <i class="fa fa-star"></i>
                                        @endfor
                                        @for($i = 1; $i <= 5-$row->score_user; $i++)
                                        <i class="fa fa-star-o"></i>
                                        @endfor

                        </div>
  <span>Par {{$row->nom . " " . $row->prenom }}, le {{$row->created_at}}</span>
</div>


@endforeach



                          
                      </div>


                        
                    </div>


                    
                </div>
                
            </div>
            
        </div>

@endsection
        <style>



body {
    background-color: #f7f6f6
}

.card {
    
    border: none;
    box-shadow: 5px 6px 6px 2px #e9ecef;
    border-radius: 4px;
}


.dots{

    height: 4px;
  width: 4px;
  margin-bottom: 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}

.badge{

        padding: 7px;
        padding-right: 9px;
    padding-left: 16px;
    box-shadow: 5px 6px 6px 2px #e9ecef;
}

.user-img{

    margin-top: 4px;
}

.check-icon{

    font-size: 17px;
    color: #c3bfbf;
    top: 1px;
    position: relative;
    margin-left: 3px;
}

.form-check-input{
    margin-top: 6px;
    margin-left: -24px !important;
    cursor: pointer;
}


.form-check-input:focus{
    box-shadow: none;
}


.icons i{

    margin-left: 8px;
}
.reply{

    margin-left: 12px;
}

.reply small{

    color: #b7b4b4;

}


.reply small:hover{

    color: green;
    cursor: pointer;

}
        </style>
        <style>
/* Style pour le profil utilisateur */
.profile {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 40px;
}

.profile img {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  margin-bottom: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.profile h2 {
  font-size: 2rem;
  margin-bottom: 10px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.profile p {
  font-size: 1rem;
  margin-bottom: 20px;
  color: #999;
}

/* Style pour les commentaires */
.comment {
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  margin-bottom: 40px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.comment h3 {
  font-size: 1.2rem;
  margin-bottom: 10px;
}

.comment p {
  font-size: 1rem;
  margin-bottom: 10px;
}

.comment span {
  font-size: 0.8rem;
  color: #999;
}

</style>