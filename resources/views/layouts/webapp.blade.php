<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
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
    <link href="{{ asset('css/webapp.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div id="app">

        @foreach ($tienda_id as $t)
            <?php $tienda_id = $t->id; ?>
        @endforeach

        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                    
                    <router-link :to="{ name: 'tiendaHome', params: { tienda_id: {{ $tienda_id }} }}">
                        {{ $tienda->nombre }}
                </router-link>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                        </li>
                    </ul>



                </div>
                <router-link :to="{ name: 'cartHome', params: { tienda_id: {{ $tienda_id }} }}"
                    class="btn btn-primary">
                    Ver carrito
                </router-link>
                <a href="http://127.0.0.1:8000"> volver</a>

            </div>


        </nav>

        <main>
            @yield('content')
        </main>


    </div> {{-- cierra el div=app de vue, del layout.web --}}

</body>

<footer class="mt-5">
    <a href="http://127.0.0.1:8000">miapp.store</a>
    <a href="/">miapp.store2</a>

</footer>
