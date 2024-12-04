<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Theatrees</title>
        <!-- Bootstrap -->
        <link href="/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Animate.css -->
        <link href="/animate.css/animate.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome iconic font -->
        <link href="/fontawesome/css/fontawesome-all.css" rel="stylesheet" type="text/css" />
        <!-- Magnific Popup -->
        <link href="/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
        <!-- Slick carousel -->
        <link href="/slick/slick.css" rel="stylesheet" type="text/css" />
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Oswald:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
        <!-- Theme styles -->
        <link href="/css/dot-icons.css" rel="stylesheet" type="text/css">
        <link href="/css/theme.css" rel="stylesheet" type="text/css">
        <style>
body {
  font-family: Arial, Helvetica, sans-serif;
}


.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  width:150px;
  position: absolute;
  background-color: #E7F6F2;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}


.dropdown:hover .dropdown-content {
  display: block;
}
</style>
    </head>
    <body class="body" style="background-color:#2C3333">
        <header class="header header-horizontal header-view-pannel">
            <div class="container">
                <nav class="navbar">
                    <a class="navbar-brand" href="./">
                        <span class="logo-element">
                            <span class="logo-text text-uppercase">
                                <img src="/images/svg/logo.png" width="75px">
                                <b class="font-weight-light">Theatrees</b></span>
                        </span>
                    </a>

                    {{-- @if (!Auth::check())
                    <a class="nav-link text-decoration-none text-white" href="/login">Login</a>
                    @else --}}

                    <button class="navbar-toggler" type="button">
                        <span class="th-dots-active-close th-dots th-bars">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                    <div class="navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            </li>
                        </ul>
                        <div class="navbar-extra">
                            <a class="btn-theme btn" style="background-color: #395B64; border-radius: 15px" href="{{route('tiket')}}"><i class="fas fa-ticket-alt"></i>&nbsp;&nbsp;Tickets</a>&nbsp;&nbsp;
                            <div class="dropdown">
                              <button class="dropbtn"><img src="/images/svg/profile.png" width="35px">
                              </button>
                              <div class="dropdown-content" style="border-radius: 10px">
                                <a  href="{{route('profile')}}" style="">Profile</a>
                                <a  href="{{route('my_ticket')}}" style="">My Ticket</a>
                                <a  href="{{route('logout')}}" style="">Sign Out</a>
                              </div>
                            </div> 
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <br><br><br><br><br>
        @if($title=="HOME")
@include('../template/main');
        @elseif($title=="TICKET")
@include('../template/ticket');
        @elseif($title=="PROFILE")
@include('../template/PROFILE');
        @elseif($title=="MY TICKET")
@include('../template/tiket');
        @elseif($title=="PAY")
@include('../template/pays');
        @elseif($title=="BUY")
@include('../template/buy');
        @endif
        <a class="scroll-top disabled" href="#"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
        <footer class="flex-shrink-0 section-text-white footer footer-links" style="background-color:#2C3333">
                
            <div class="footer-copy">
                <div class="container text-white-50"><strong>&copy; 2023 Theatrees Group.</strong>
                  All rights reserved.</div>
            </div>
        </footer>
        
        <!-- jQuery library -->
        <script src="/js/jquery-3.3.1.js"></script>
        <!-- Bootstrap -->
        <script src="/bootstrap/js/bootstrap.js"></script>
        <!-- Paralax.js -->
        <script src="/parallax.js/parallax.js"></script>
        <!-- Waypoints -->
        <script src="/waypoints/jquery.waypoints.min.js"></script>
        <!-- Slick carousel -->
        <script src="/slick/slick.min.js"></script>
        <!-- Magnific Popup -->
        <script src="/magnific-popup/jquery.magnific-popup.min.js"></script>
        <!-- Inits product scripts -->
        <script src="/js/script.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJ4Qy67ZAILavdLyYV2ZwlShd0VAqzRXA&callback=initMap"></script>
        <script async defer src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/js/rating.js"></script>
    </body>
</html>