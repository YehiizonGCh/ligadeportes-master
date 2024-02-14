@extends('adminlte::page')

@section('title', 'Home')



@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class=" row">
        <div class="col-md-4 col-xl-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h1 class="card-title">Bienvenid@ {{ Auth::user()->name }}</h1>
                </div>
                <div class="card-body">
                    <p>Panel de Administración de Eventos de Futbol</p>
                </div>
            </div>
        </div>

    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">

                    <div class="col-md-4 col-xl-3">
                        <div class="small-box bg-gradient-info">
                            <div class="inner">
                                @php
                                use App\Models\User;
                                $cant_usuarios = User::count();
                            @endphp
                            <h3><span>{{ $cant_usuarios }}</span></h3>
                                <p>Usuarios</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="/usuarios" class="small-box-footer">
                                Acceder <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="small-box bg-gradient-success">
                            <div class="inner">
                                @php
                                use App\Models\Equipo;
                                $cant_equipos = Equipo::count();
                            @endphp
                            <h3><span>{{ $cant_equipos }}</span></h3>
                                <p>Inscripciones</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <a href="/equipos" class="small-box-footer">
                                Acceder <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="small-box bg-gradient-danger">
                            <div class="inner">
                                @php
                                use App\Models\Partido;
                                $cant_partidos = Partido::count();
                            @endphp
                            <h3><span>{{ $cant_partidos }}</span></h3>
                                <p>Partidos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="/partidos" class="small-box-footer">
                                Acceder <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="small-box bg-gradient-warning">
                            <div class="inner">
                                <h3>10</h3>
                                <p>Posiciones</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Acceder <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.css">

@stop

