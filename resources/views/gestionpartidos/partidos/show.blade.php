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
                    <li class="breadcrumb-item"><a href="{{ route('partidos.index') }}"><i
                                class="fas fa-users mr-2"></i>Partidos</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-eye mr-2"></i>Detalles del Partido</li>
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
                                <img src="{{ asset('https://cdn-icons-png.flaticon.com/512/3048/3048379.png') }}"
                                    alt="" width="40" height="40" class="mr-2">
                                <h3 class="card-text "><b> DETALLES DEL PARTIDO</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-5">
                                <img src="{{ asset($partido->equipolocal->club->logo) }}"
                                    alt="" width="100" height="100" class="mr-2">
                                <h3 class="card-text "><b>{{ $partido->equipolocal->nombre }}</b></h3>
                            </div>
                            @if ($partido->estado == 1)
                                <div class="col-md-2">
                                    <h3 class="card-text "><b>VS</b></h3>
                                </div>
                            @else
                                <div class="col-md-2">
                                    <h3 class="card-text "><b>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->goles_local : 0 }} - {{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->goles_visitante : 0 }}</b></h3>
                                </div>
                            @endif

                            <div class="col-md-5">
                                <img src="{{ asset($partido->equipovisitante->club->logo) }}"
                                    alt="" width="100" height="100" class="mr-2">
                                <h3 class="card-text "><b>{{ $partido->equipovisitante->nombre }}</b></h3>
                            </div>
                        </div>
                    </div>




                    <div class="card-body">
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item-action py-1"><b>Fecha del Partido:</b> {{ $partido->fecha_partido }}
                            </li>
                            <li class="list-group-item-action py-1"><b>Hora del Partido:</b> {{ $partido->hora_partido }}
                            </li>
                            <li class="list-group-item-action py-1"><b>Lugar:</b> {{ $partido->lugar }}</li>
                            <li class="list-group-item-action py-1"><b>Observación:</b> {{ $partido->observacion }}</li>
                            <li class="list-group-item-action py-1"><b>Estado:</b> @if ($partido->estado == 1)
                                    <span class="badge badge-success">Pendiente</span>
                                @else
                                    <span class="badge badge-danger">Jugado</span>
                                @endif
                            </li>
                            <!-- Include more relevant match details -->
                        </ul>
                    </div>

                    <!-- Mostrar nombres de jugadores que marcaron gol y minutos -->
                    @if ($partido->jugadoresencuentros->isNotEmpty())
                    <li class="list-group-item-action py-1">
                        <b>Jugadores que marcaron gol:</b>
                        <ul>
                            @foreach ($partido->jugadoresencuentros as $jugadorencuentro)
                                @if ($jugadorencuentro->goles > 0)
                                    <li>
                                        {{ $jugadorencuentro->jugador->nombres }} {{ $jugadorencuentro->jugador->apellido_paterno }}
                                        (Minutos: {{ implode(', ', $jugadorencuentro->minuto_gol) }})
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @endif

                    <ul class="nav nav-tabs justify-content-center  nav-pills " id="myTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="estadistica-tab" data-toggle="tab" href="#estadistica">Estadistica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cambios-tab" data-toggle="tab" href="#cambios">Cambios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="jugadores-tab" data-toggle="tab" href="#jugadores">Jugadores</a>
                        </li>
                    </ul>
                    {{-- validar estado y si no mostrar el acordeon --}}
                    @if ($partido->estado == 1)
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <p>El partido aún no se ha jugado.</p>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade show active" id="estadistica">
                            <!-- Contenido de la pestaña Estadística -->
                            <div class="card-body  table-responsive   table-hover">
                                
        
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
                                            <td>{{ $partido->equipolocal->nombre }}
                                            </td>
                                            <td>Equipo</td>
                                            <td>{{ $partido->equipovisitante->nombre }}
                                        </tr>
                                        <tr>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->goles_local : 0 }}
                                            </td>
                                            <td>Goles</td>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->goles_visitante : 0 }}
                                        </tr>
                                        <tr>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->corners_local : 0 }}
                                            <td>Tiros de esquina</td>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->corners_visitante : 0 }}
                                        </tr>
                                        <tr>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->faltas_local : 0 }}
                                            </td>
                                            <td>Faltas</td>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->faltas_visitante : 0 }}
                                        </tr>
                                        <tr>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->tarjetas_amarillas_local : 0 }}
                                            </td>
                                            <td>Tarjetas amarillas</td>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->tarjetas_amarillas_visitante : 0 }}
                                        </tr>
                                        <tr>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->tarjetas_rojas_local : 0 }}
                                            </td>
                                            <td>Tarjetas rojas</td>
                                            <td>{{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->tarjetas_rojas_visitante : 0 }}
                                        </tr>
        
                                    </tbody>
                                </table>
            
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cambios">
                            <!-- Contenido de la pestaña Cambios -->
                            <h4 class="mt-3">Cambios de Jugadores</h4>
                                @if ($partido->jugadorescambios->isNotEmpty())
                                    @foreach ($cambios as $jugadorcambio)
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <strong> Equipo del jugador:</strong>
                                                        <img src="{{ asset($jugadorcambio->jugadorEntra->equipos->club->logo) }}"
                                                            width="40" height="40"
                                                            style="border-radius: 50%; border: 2px solid rgb(177, 190, 188);"
                                                            class="mr-2">
                                                        {{ $jugadorcambio->jugadorEntra->equipos->nombre }}                                                         
                                                    </li>
                                                    {{-- Otras propiedades del cambio --}}
                                                    <li class="list-group-item">
                                                        <strong><i class="fas fa-arrow-circle-up" style="color: #2fb98b"></i> Jugador que Entra:</strong>
                                                        {{ $jugadorcambio->jugadorEntra->nombres }} {{ $jugadorcambio->jugadorEntra->apellido_paterno }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong> <i class="fas fa-arrow-circle-down" style="color: rgb(91, 5, 27)"></i> Jugador que Sale:</strong>
                                                        {{ $jugadorcambio->jugadorSale->nombres }} {{ $jugadorcambio->jugadorSale->apellido_paterno }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>Minuto del Cambio:</strong>
                                                        {{ $jugadorcambio->minuto_cambio }}'
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>Observación del Cambio:</strong>
                                                        {{ $jugadorcambio->observacion_cambio }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No hay cambios registrados.</p>
                                @endif
                        </div>
                        <div class="tab-pane fade" id="jugadores">
                            <!-- Contenido de la pestaña Jugadores -->
                            <p>Contenido de la pestaña Jugadores.</p>
                            <div class="row">
                                
                        
                                <div class="col-md-6">
                                    <h4>Titulares - {{ $partido->equipolocal->nombre }}</h4>
                                    <ul>
                                        @foreach ($jugadoresTitularesLocal as $jugador)
                                            <li>{{ $jugador->nombres }} {{ $jugador->apellido_paterno }} {{ $jugador->apellido_materno }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <h4>Titulares - {{ $partido->equipovisitante->nombre }}</h4>
                                    <ul>
                                        @foreach ($jugadoresTitularesVisitante as $jugador)
                                            <li>{{ $jugador->nombres }} {{ $jugador->apellido_paterno }} {{ $jugador->apellido_materno }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                
                            </div>
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Suplentes - {{ $partido->equipolocal->nombre }}</h4>
                                    <ul>
                                        @foreach ($jugadoresSuplentesLocal as $jugador)
                                            <li>{{ $jugador->nombres }} {{ $jugador->apellido_paterno }} {{ $jugador->apellido_materno }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                        
                                <div class="col-md-6">
                                    <h4>Suplentes - {{ $partido->equipovisitante->nombre }}</h4>
                                    <ul>
                                        @foreach ($jugadoresSuplentesVisitante as $jugador)
                                            <li>{{ $jugador->nombres }} {{ $jugador->apellido_paterno }} {{ $jugador->apellido_materno }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endif




                    <div class="card-footer">
                        <a href="{{ route('partidos.edit', $partido->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i> Editar</a>
                        <a href="{{ route('partidos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                            Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
