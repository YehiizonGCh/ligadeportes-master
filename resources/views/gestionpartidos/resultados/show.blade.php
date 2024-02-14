@extends('adminlte::page')

@section('title', 'Detalles del Partido')
@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('resultados.index') }}"><i
                                class="fas fa-poll mr-2"></i>Resultados</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-eye mr-2"></i>Detalles del Partido</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card responsive">
                    <div class="card-header ">
                        <div class="row text-center">
                            <div class="col-md-12 d-flex align-items-center">
                                <img src="{{ asset('https://cdn-icons-png.flaticon.com/128/4389/4389651.png') }}"
                                    alt="" width="40" height="40" class="mr-2">
                                <h3 class="card-text "><b> DETALLES DEL PARTIDO</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row text-center">
                            @if ($estadisticapartido->partido)
                                <div class="col-md-5">
                                    <img src="{{ asset($estadisticapartido->partido->equipolocal->club->logo) }}"
                                        alt="" width="100" height="100" class="mr-2">
                                    <h3 class="card-text "><b>{{ $estadisticapartido->partido->equipolocal->nombre }}</b>
                                    </h3>
                                </div>

                                <div class="col-md-2">
                                    <h3 class="card-text ">
                                        <b>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->goles_local : 0 }}
                                            -
                                            {{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->goles_visitante : 0 }}</b>
                                    </h3>
                                </div>


                                <div class="col-md-5">
                                    <img src="{{ asset($estadisticapartido->partido->equipovisitante->club->logo) }}"
                                        alt="" width="100" height="100" class="mr-2">
                                    <h3 class="card-text ">
                                        <b>{{ $estadisticapartido->partido->equipovisitante->nombre }}</b>
                                    </h3>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <p>No se encontró información del partido.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="card-body  table-responsive   table-hover">
                        <div class="row text-center mb-3">
                            <div class="col-md-12">

                                <img src="{{ asset('https://cdn-icons-png.flaticon.com/128/6452/6452057.png') }}"
                                    alt="" width="60" height="60" class="mr-2">
                            </div>
                        </div>

                        {{-- tabla de 3 columnas --}}
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>EQUIPO LOCAL</th>
                                    <th>ESTADISTICA DEL EQUIPO</th>
                                    <th>EQUIPO VISITANTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $estadisticapartido->partido->equipolocal->nombre }}
                                    </td>
                                    <td>Equipo</td>
                                    <td>{{ $estadisticapartido->partido->equipovisitante->nombre }}
                                </tr>
                                <tr>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->goles_local : 0 }}
                                    </td>
                                    <td>Goles</td>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->goles_visitante : 0 }}
                                </tr>
                                <tr>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->corners_local : 0 }}
                                    <td>Tiros de esquina</td>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->corners_visitante : 0 }}
                                </tr>
                                <tr>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->faltas_local : 0 }}
                                    </td>
                                    <td>Faltas</td>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->faltas_visitante : 0 }}
                                </tr>
                                <tr>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->tarjetas_amarillas_local : 0 }}
                                    </td>
                                    <td>Tarjetas amarillas</td>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->tarjetas_amarillas_visitante : 0 }}
                                </tr>
                                <tr>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->tarjetas_rojas_local : 0 }}
                                    </td>
                                    <td>Tarjetas rojas</td>
                                    <td>{{ $estadisticapartido->partido->estadisticaspartidos->isNotEmpty() ? $estadisticapartido->partido->estadisticaspartidos->first()->tarjetas_rojas_visitante : 0 }}
                                </tr>

                            </tbody>
                        </table>






                        <div class="card-footer">
                            <a href="{{ route('resultados.edit', $estadisticapartido->id) }}" class="btn btn-warning "
                                title="Editar resultado">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                            <a href="{{ route('resultados.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left"></i>
                                Volver</a>
                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
