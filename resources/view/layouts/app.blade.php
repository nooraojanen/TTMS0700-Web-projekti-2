<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kauppa X</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    
</head>

<body>
    <div id="app">
       <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/etusivu">Kauppa X</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                
                    <li class="nav-item dropdown">
                            <a class="nav-link" href="/naiset" role="button">
                              NAISET
                            </a>                          </li>

                <li class="nav-item dropdown">
                        <a class="nav-link" href="/miehet" role="button">
                          MIEHET
                        </a>
                      </li>
                
              </ul>

               <form action="/search" method="get">
    <label for="query"></label>
    <input type="query" id="query" name="query">
    <input type="submit" value="Etsi">  </button>
 </form>

           
        </span>
    </div>
</form>
                
              </form>
              <button class="btn my-2 my-sm-0" type="button"><a href="/tulostakori"><i class="fas fa-shopping-cart" style="color:white;"></i></a></button>
            </div>
          </nav>
        @yield('content')
<div class="container p-3"></div>
<footer class="page-footer bg-dark footer fixed-bottom" style="color: white;">
    <div class="container-fluid"><div class="footer-copyright text-center py-3">  2019 Copyright Johanna Kaasalainen, Laura Alakorte, Maria Salonen, Noora Ojanen
        </div></div>
</footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>