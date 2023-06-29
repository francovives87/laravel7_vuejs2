@extends('layouts.adminlte')

@section('content')

    @foreach ($tienda as $t)
        <?php $tienda_id = $t->id; ?>
        <?php $tienda_nombre = $t->nombre; ?>
    @endforeach
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/{{ $tienda_nombre }}" class="brand-link">
            <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">miapp.store/{{ $tienda_nombre }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="" class="" alt="">
                </div>
                <div class="info">
                    <a href="/cuenta/home" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                                       with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link :to="{name: 'home'}" class="nav-link">
                            <i class="nav-icon fas fa-desktop"></i>
                            <p>
                                Escritorio
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fas fa-box"></i>
                            <p>
                                Productos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link
                                    :to="{ name: 'categorie', params: { user: {{ Auth::user()->id }}, tienda_id:{{ $tienda_id }} }}"
                                    class="nav-link">
                                    <i class="fas fa-align-justify"></i>
                                    <p>Categorias</p>
                                </router-link>
                            </li>
                            <li class="nav-item">

                                <router-link
                                    :to="{ name: 'homeProduct', params: { user: {{ Auth::user()->id }}, tienda_id:{{ $tienda_id }} }}"
                                    class="nav-link">
                                    <i class="fab fa-product-hunt"></i>
                                    <p>Productos</p>
                                </router-link>
                            </li>
                            <li class="nav-item">

                                <router-link
                                    :to="{ name: 'homeVariation', params: { user: {{ Auth::user()->id }}, tienda_id:{{ $tienda_id }} }}"
                                    class="nav-link">
                                    <i class="fas fa-asterisk"></i>
                                    <p>Variaciones</p>
                                </router-link>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'homePedidos', params: { user: {{ Auth::user()->id }}, tienda_id:{{ $tienda_id }} }}"
                            class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            <p>
                                Pedidos
                            </p>
                        </router-link>
                    </li>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <router-view></router-view>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

@endsection
