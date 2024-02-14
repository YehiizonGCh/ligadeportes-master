@extends('adminlte::page')

@section('title', 'Detalles de la Categoria')
@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}"><i
                                class="fas fa-shield-alt mr-2"></i>Categorias</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-eye mr-2"></i>Ver Categoria</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card responsive">
                    <div class="card-header ">
                        <div class="row text-center">
                            <div class="col-md-12 d-flex align-items-center">
                                <img src="{{ asset($categoria->torneos->logo) }}" width="50" height="50"
                                    style="border-radius: 20%; border: 2px solid rgb(177, 190, 188);" class="mr-2">
                                <h3 class="card-text "><b> DETALLES DE LA CATEGORIA </b></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item-action py-1 "><b>NOMBRE DE LA CATEGORIA: </b>
                                    {{ $categoria->nombre }}
                                </li>
                                <li class="list-group-item-action py-1"><b>TORNEO INSCRITO:</b>
                                    {{ $categoria->torneos->nombre }}</li>
                                <li class="list-group-item-action py-1"><b>ABREVIATURA:</b> {{ $categoria->abreviatura }}
                                </li>
                                <li class="list-group-item-action py-1"><b>EDAD MINIMA:</b> {{ $categoria->edad_minima }}
                                    Años</li>
                                <li class="list-group-item-action py-1"><b>EDAD MAXIMA:</b> {{ $categoria->edad_maxima }}
                                    Años</li>
                                <li class="list-group-item-action py-1"><b>TEMPORADA:</b>
                                    {{ $categoria->torneos->temporada }}</li>
                                <li class="list-group-item-action py-1"><b>ESTADO:</b>
                                    @if ($categoria->estado)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Inactivo</span>
                                    @endif
                                </li>
                            </ul>
                        </div>


                        <div class="card-body table-responsive">
                            <h3 class="mb-0"><b>EQUIPOS INSCRITOS</b></h3>
                            <table class="table table-hover table-sm">
                                <thead class="text-white" style="background-color: #6a6b6b">
                                    <tr>
                                        <th>Nombre del Equipo</th>
                                        <th>Club</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($equipos as $equipo)
                                        <tr>
                                            <td>{{ $equipo->nombre }}</td>
                                            <td>{{ $equipo->club->nombre }}</td>
                                            <td>
                                                @if ($equipo->estado)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">No hay equipos registrados en esta
                                                categoría.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('categorias.index') }}" class="btn btn-primary"><i
                                class="fas fa-arrow-circle-left"></i> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
