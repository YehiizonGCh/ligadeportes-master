@extends('adminlte::page')

@section('title', 'Jugadores')
@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jugadores.index') }}"><i
                                    class="fas fa-shield-alt mr-2"></i>Jugadores</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-eye mr-2"></i>Ver Jugador</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg 8">
                <div class="card">
                    <div class="card-header d-flex align-items-center"">
                    <img src="{{ asset($jugador->foto) }}" alt="{{ $jugador->nombres }} " width="50" height="50"
                            style="border-radius: 20%; border: 2px solid rgb(177, 190, 188);" class="mr-2">
                        <h3 style="text-transform: uppercase; margin-top: 10px;">{{ $jugador->nombres }}</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Jugador</th>
                                    <td style="width: 70%;">{{ $jugador->nombres }}</td>
                                </tr>
                                <tr>
                                    <th>Posición</th>
                                    <td>{{ $jugador->posicion }}</td>
                                </tr>
                                <tr>
                                    <th>Dorsal</th>
                                    <td>{{ $jugador->dorsal }}</td>
                                </tr>
                                <tr>
                                    <th>Edad</th>
                                    <td>{{ $jugador->edad }}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        @if ($jugador->estado)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('jugadores.index') }}" class="btn btn-info"><i
                                class="fas fa-arrow-circle-left"></i> Volver</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
