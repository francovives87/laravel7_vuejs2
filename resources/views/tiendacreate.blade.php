@extends('layouts.app')


@section('mapStyles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css" />
@endsection

@section('content')
    <section>
        <div class="container">
            <form method="POST" action="/create/tienda/store" id="tiendaCreate">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6">


                        <div class="card">
                            <div class="card-header">
                                Informacion Basica
                            </div>

                            <div class="card-body">

                                <div>

                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre de la tienda: <span class="smallImportant">*</span></label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        aria-describedby="emailHelp">
                                    @error('nombre')
                                        <br>
                                        <small>*{{ $message }}</small>
                                        <br>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="categoria">Categoria: <span class="smallImportant">*</span></label></label>
                                    <select name="categoria" id="categoria" class="form-control">
                                        @foreach ($tiendaCategorias as $categoria)
                                            <option>{{ $categoria->nombre }}</option>
                                        @endforeach

                                    </select>
                                    @error('categoria')
                                        <br>
                                        <small>*{{ $message }}</small>
                                        <br>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="telefono">Telefono de la tienda</label>
                                    <p><small>Telefono para recibir ordens y consultas al WhatApps</small></p>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        aria-describedby="emailHelp" placeholder="+54 9 341 6889900">
                                    @error('telefono')
                                        <br>
                                        <small>*{{ $message }}</small>
                                        <br>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="descripcion">Descripcion de la tienda: <span class="smallImportant">*</span></label></label>
                                    <textarea class="form-control" id="descripcion" aria-describedby="emailHelp"
                                        name="descripcion"></textarea>
                                    @error('descripcion')
                                        <br>
                                        <small>*{{ $message }}</small>
                                        <br>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="card">
                            <div class="card-header">
                                Geolocalizacion
                            </div>
                            <div class="card-body">
                                <small>No es obligatoria, pero sirve para agregar su tienda a nuesto mapa y que los usuarios busquen por cercania</small>
                                <div class="form-group mt-2">
                                    <label for="inputBuscar">Buscar direccion:</label>
                                    <input type="text" name="" id="inputBuscar" class="form-control"
                                        value="{{ old('inputBuscar') }}"
                                        placeholder="Avenida San Martin 3000 Rosario Argentina">
                                    @error('inputBuscar')
                                        <br>
                                        <small>*{{ $message }}</small>
                                        <br>
                                    @enderror
                                    <button type="button" class="btn btn-primary mt-2" id="btnBuscar">Buscar</button>
                                    <button type="button" class="btn btn-success mt-2" id="LatLgnBrowser">Obtener del
                                        navegador</button>
                                    <button type="button" class="btn btn-light mt-2" id="btnLimpiar">Limpiar</button>
                                </div>

                                <div class="form-group">
                                    <div id="mapa" style="height:400px;"></div>
                                </div>
                                <input type="hidden" name="pais" id="pais">

                                <input type="hidden" name="region" id="region">

                                <input type="hidden" name="subregion" id="subregion">

                                <input type="hidden" name="ciudad" id="ciudad">
                                <h5>Confirme Geolocalizacion exacta:</h5>
                                <div class="form-group">
                                    <label for="direccion">Direccion:</label>
                                    <input type="text" name="direccion" id="direccion" class="form-control">
                                </div>

                                <input type="hidden" name="codigo_postal" id="codigo_postal">

                                <input type="hidden" name="barrio" id="barrio">

                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">

                            </div>
                        </div>
                    </div>

                </div>
            </form> {{-- cierro form --}}
            <div class="row align-center">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <p class="float-left">Complete los campos obligatorios <span class="smallImportant">*</span> y haga click en el boton Crear tienda ahora!</p>
                            <button type="submit" form="tiendaCreate" class="btn btn-primary float-right">Crear tienda ahora!</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>

    </section>
@endsection


@section('mapScripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="">
    </script>

    <style>
       .smallImportant{
           color: red;
       }

    </style>
    <script>

    </script>

    <script src="https://unpkg.com/esri-leaflet" defer></script>

    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

@endsection
