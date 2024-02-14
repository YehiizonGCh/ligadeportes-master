@extends('adminlte::page')

@section('title', 'Club')
@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('clubs.index') }}"><i
                                    class="fas fa-shield-alt mr-2"></i>Clubs</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-eye mr-2"></i>Ver Club</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center" >

                        <img src="{{ asset($club->logo) }}" alt="{{ $club->nombre }} " width="50" height="50"
                            style="border-radius: 20%; border: 2px solid rgb(177, 190, 188);" class="mr-2">
                        <h3 style="text-transform: uppercase; margin-top: 10px;">{{ $club->nombre }}</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">CLUB</th>
                                    <td style="width: 70%;">{{ $club->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Abreviatura</th>
                                    <td>{{ $club->abreviatura }}</td>
                                </tr>
                                <tr>
                                    <th>Temporada</th>
                                    <td>{{ $club->temporada }}</td>
                                </tr>
                                <tr>
                                    <th>Domicilio</th>
                                    <td>{{ $club->domicilio }}</td>
                                </tr>
                                <tr>
                                    <th>Representante</th>
                                    <td>{{ $club->representante }}</td>
                                </tr>
                                <tr>
                                    <th>DNI Representante</th>
                                    <td>{{ $club->dni_representante }}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        @if ($club->estado)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Categorías en las que participa</th>
                                    <td>
                                        <ul style="list-style-type: none; padding-left: 0;">
                                            @foreach ($categorias as $id => $nombre)
                                                @if ($club->categorys->contains($id))
                                                    <li>
                                                        <input type="checkbox" name="categorias[]"
                                                            id="categoria_{{ $id }}" value="{{ $id }}"
                                                            checked disabled>
                                                        <label for="categoria_{{ $id }}"
                                                            style="margin-left: 5px; color: #3498db;">{{ $nombre }}</label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('clubs.index') }}" class="btn btn-info"><i
                                class="fas fa-arrow-circle-left"></i> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
