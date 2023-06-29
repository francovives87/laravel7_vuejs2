@extends('adminlte::page')


@section('title', 'Administrador')

@section('content_header')
  
@stop

@section('content')

<h2>Administracion de mi tienda</h2>

@foreach ($tienda as $item)
    <h4>mi tienda: miapp.store/{{$item->nombre}}</h4>
@endforeach
    <p>Bienvenido {{Auth::user()->name}}</p>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    
@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}