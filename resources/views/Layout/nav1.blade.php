<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title','')</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/main.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    



</head>

<body>
    <header>

        <nav id="navigation">
            <!-- container -->
            <div class="container">
                <div id="responsive-nav">
                    <ul class="main-nav nav navbar-nav">
                    @guest
                        @if (Route::has('login'))
                                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href={{url("/")}}>Acceuil</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href={{url("/")}}>Acceuil</a></li>

                            <li class="nav-item dropdown {{ Request::is('users.edit-profile') || Request::is('contrats-view') ? 'active' : '' }}">

                                <a id="navbarDropdown"  class="nav-link dropdown-toggle {{ Request::is('users.edit-profile') || Request::is('contrats-view') ? 'active' : '' }}"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->prenom}} 
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('users.edit-profile') }}"> 
                                        Profil
                                    </a> <br>

                                    <a class="dropdown-item" href="{{ route('contrats-view') }}"> 
                                        Mes contrats
                                    </a> <br>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ Request::is('add_ann') || Request::is('consulter') ? 'active' : '' }}">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle {{ Request::is('add_ann') || Request::is('consulter') ? 'active' : '' }} " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Annonces
                                </a>
                                <div class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/add_ann">
                                        Ajouter une annonce
                                    </a>
                                    <a class="dropdown-item" href="/consulter">
                                        Consulter vos annonces
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ Request::is('addo') || Request::is('consulter_objects') ? 'active' : '' }}">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle {{ Request::is('addo') || Request::is('consulter_objects') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Objects
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/addo">
                                        Ajouter une Objet
                                    </a>
                                    <a class="dropdown-item" href="/consulter_objects">
                                        Consulter vos objects
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown ">
                                @auth
                                    <a id="navbarDropdown"  class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-bell"></i>
                                                Notifications
                                    </a>
                                    @endauth
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    
                                        <a class="dropdown-item" href="{{ route('locations.demandes-de-reservation') }}"> 
                                            Demandes de réservation
                                        </a> <br>
    
                                    </div>
                                </li>
                        
            
        
            @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
         <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-4">
                        <div class="header-search">
                            <form>
                               
                               
                                <input id="search" class="input-select" placeholder="Search here">
                                <button class="search-btn">Search</button>
                            </form>
                            
                    
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    @if (Auth::check()) 
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-bell"></i>
                                    <span>Notifications</span>
                                    <div class="qty" id="notification-count"></div>
                                </a>
                               
                                <div class="cart-dropdown">
                                <div id="notifcomment" class="cart-list">
                                   
                                        
                                 </div>
                                    </div>
                              
                                    
                                </div>
                            </div>


                            <!-- /Cart -->
                        </div>
                    </div>

                    
                    <!-- /ACCOUNT -->
                </div>

                @endif
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->

    </header>
    {{ session('successcomment') }}
    
@if (session('successcomment'))
     <div id="alert-success" class="alert alert-success">
        {{ session('successcomment') }}
    </div>
    <script>
        setTimeout(function(){
            document.getElementById('alert-success').classList.add('hide');
        }, 10000);
    </script>
@endif


<div>
    <div class="section">

        @yield('content')
        
    </div>

</div>
<div>
    <div>
  

      <div id="newsletter" class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="newsletter">
                            <strong>Nous contacter</strong>
                            <form>
                                <input class="input" type="email" placeholder="Enter Your Email">
                                <button class="newsletter-btn"><i class="fa fa-envelope"></i> Envoyer</button>
                            </form>
                            <ul class="newsletter-follow">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>

            </div>

<footer id="footer">

            <!-- top footer -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-4 col-xs-8">
                            <div class="footer">
                                <h3 class="footer-title">à propos de nous </h3>
                                <p>Site de location d'objets entre particuliers</p>

                            </div>
                        </div>



                        <div class="clearfix visible-xs"></div>



                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Service</h3>
                                <ul class="footer-links">
                                    <li>
                                        <a href="#"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /top footer -->


        </footer>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

        
        
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script>
            let table = new DataTable('#myTable');
        </script>
</body>

</html>
<script>
// créer une nouvelle instance de la classe Date
const date = new Date(0);

// obtenir les composantes de la date et les formater selon le format souhaité
const year = date.getFullYear();
const month = String(date.getMonth() + 1).padStart(2, '0');
const day = String(date.getDate()).padStart(2, '0');
const hours = String(date.getHours()).padStart(2, '0');
const minutes = String(date.getMinutes()).padStart(2, '0');
const seconds = String(date.getSeconds()).padStart(2, '0');

// créer la chaîne de caractères dans le format souhaité
let lastNotificationId = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
//console.log("ha");


function getNotifications() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/notifications', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var notifications = JSON.parse(xhr.responseText).notifications;
            var notifications1 = JSON.parse(xhr.responseText).notifications1;
            var count = JSON.parse(xhr.responseText).count;

            for (var i = 0; i < notifications.length; i++) {
                if (notifications[i].created_at >lastNotificationId  ) {
                    displayNotification(notifications[i]);
                    lastNotificationId = notifications[i].created_at;
                     console.log(lastNotificationId);

                }
            }
            for (var i = 0; i < notifications1.length; i++) {
                if (notifications1[i].created_at >lastNotificationId  ) {
                    displayNotification(notifications1[i]);
                    lastNotificationId = notifications1[i].created_at;
                     console.log(lastNotificationId);

                }
            }
        console.log(notifications);
        console.log(notifications1);
  // Get the `div` element by its ID
  var notificationCountDiv = document.getElementById("notification-count");

  // Set the content of the `div` element to the `count` variable
  notificationCountDiv.innerHTML = count;

        }



    };
    xhr.send();
}

function displayNotification(notification) {
  // Create the new div element
  const newDiv = document.createElement('div');
  newDiv.setAttribute('id', 'notif');
  newDiv.setAttribute('class', 'product-widget');
  
  // Add the child elements to the new div
  const childDiv = document.createElement('div');
  childDiv.setAttribute('class', 'product-body');
  
  const h3 = document.createElement('h3');
  h3.setAttribute('class', 'product-name');

  const anchor = document.createElement('a');
    if(notification.type=="2"){
          anchor.setAttribute('href', '/avisPartenaire/'+notification.id_loca);

    }
 if(notification.type=="3"){ 
          anchor.setAttribute('href', '/commentaire/'+notification.id_loca);

 } 
 if(notification.type=="1"){ 
          anchor.setAttribute('href', '/successs_'+notification.id);

 }   

  const p = document.createElement('p');
  p.textContent = notification.contenu;
  anchor.appendChild(p);
  
  h3.appendChild(anchor);
  childDiv.appendChild(h3);
  
  const deleteBtn = document.createElement('button');
  deleteBtn.setAttribute('class', 'delete');
  const i = document.createElement('i');
  i.setAttribute('class', 'fa fa-close');
  deleteBtn.appendChild(i);
  
  newDiv.appendChild(childDiv);
  newDiv.appendChild(deleteBtn);


const container = document.querySelector('#notifcomment.cart-list');
if (container) {
  container.appendChild(newDiv);
} else {
  console.error('Container element not found');
}
}

// Exécutez la fonction getNotifications() toutes les 5 secondes
setInterval(getNotifications, 1000);
</script>


<style>
.hide {
    display: none;
}

</style>