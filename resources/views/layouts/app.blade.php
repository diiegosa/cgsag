<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CGSAG</title>

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="{{ url('css/materialize.min.css')}}"  media="screen,projection"/>        
        
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <link href="{{ url('/css/materialize-app.css') }}" rel="stylesheet">
        <link href="{{ url('/css/materialize-style.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
    </head>
    <body>
        <!-- start header nav-->
        <header id="header" class="page-topbar">
            <nav class="navbar-color blue darken-3">
                <div class="nav-wrapper">
                    <a href="/people" class="hide-on-med-and-down right" id="title">Coordenação Geral de Sistemas de Apoio à Gestão</a></li>
                </div>
            </nav>
        </header>
        <!-- end header nav-->

        <section>
            @yield('content')
        </section>

        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="{{ url('/js/materialize.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/js/materialize_components_config.js') }}"></script>
    </body>
</html>
