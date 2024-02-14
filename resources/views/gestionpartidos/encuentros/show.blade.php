@extends('adminlte::page')

@section('title', 'Detalles del Encuentro Jugador')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('encuentros.index') }}"><i
                                class="fas fa-user-clock mr-2"></i>Encuentros</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-eye mr-2"></i>Detalles del Encuentro
                        Jugador</li>
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
                    <div class="card-header">
                        <h3 class="card-text">
                            <img src="{{ asset('https://cdn-icons-png.flaticon.com/512/3048/3048379.png') }}"
                                title="Registro de Partido" alt="" width="40" height="40" class="mr-2">
                            <b>DETALLE DEL JUGADOR QUE PARTICIPÓ</b>
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-5">
                                <img src="{{ asset($jugadorencuentro->partido->equipolocal->club->logo) }}" alt=""
                                    width="100" height="100" class="mr-2">
                                <h3 class="card-text "><b>{{ $jugadorencuentro->partido->equipolocal->nombre }}</b></h3>
                            </div>
                            <div class="col-md-2">
                                <h3 class="card-text ">
                                    <b>{{ $jugadorencuentro->partido->estadisticaspartidos->isNotEmpty() ? $jugadorencuentro->partido->estadisticaspartidos->first()->goles_local : 0 }}
                                        -
                                        {{ $jugadorencuentro->partido->estadisticaspartidos->isNotEmpty() ? $jugadorencuentro->partido->estadisticaspartidos->first()->goles_visitante : 0 }}</b>
                                </h3>
                            </div>

                            <div class="col-md-5">
                                <img src="{{ asset($jugadorencuentro->partido->equipovisitante->club->logo) }}" alt=""
                                    width="100" height="100" class="mr-2">
                                <h3 class="card-text "><b>{{ $jugadorencuentro->partido->equipovisitante->nombre }}</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h4>Detalles del Partido</h4>
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item-action py-1">
                                <strong>Fecha y Hora del Partido:</strong>
                                {{ $jugadorencuentro->partido->fecha_partido }} --
                                {{ $jugadorencuentro->partido->hora_partido }}
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Equipo que pertenece:</strong>
                                {{ $jugadorencuentro->jugador->equipos->nombre }}
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Categoria:</strong>
                                {{ $jugadorencuentro->jugador->equipos->categoria->nombre }}
                            </li>
                        </ul>

                        <h4>Detalles del Jugador</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item-action py-1">
                                <strong>Jugador:</strong>
                                {{ $jugadorencuentro->jugador->nombres }}
                                {{ $jugadorencuentro->jugador->apellido_paterno }}
                                {{ $jugadorencuentro->jugador->apellido_materno }}
                                ({{ $jugadorencuentro->jugador->posicion }})
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Foto:</strong>
                                <img src="{{ asset($jugadorencuentro->jugador->foto) }}" width="30" height="30"
                                    style="border-radius: 50%; border: 2px solid rgb(177, 190, 188);" class="mr-2">
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Titular:</strong>
                                {{ $jugadorencuentro->titular ? 'Sí' : 'No' }}
                            </li>
                        </ul>

                        <h4>Estadísticas</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item-action py-1">
                                <strong>Goles:</strong> {{ $jugadorencuentro->goles }}
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Autogoles:</strong> {{ $jugadorencuentro->autogoles }}
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Asistencias:</strong> {{ $jugadorencuentro->asistencias }}
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Amarillas:</strong> {{ $jugadorencuentro->amarillas }}
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Rojas:</strong> {{ $jugadorencuentro->rojas }}
                            </li>
                        </ul>

                        <h4>Observaciones</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item-action py-1">
                                <strong>Observación por la tarjeta amarilla:</strong>
                                {{ $jugadorencuentro->observacion_targeta_amarilla }}
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Observación por la tarjeta roja:</strong>
                                {{ $jugadorencuentro->observacion_targeta_roja }}
                            </li>
                            <li class="list-group-item-action py-1">
                                <strong>Observación por el gol:</strong>
                                {{ $jugadorencuentro->observacion_goles }}
                            </li>
                        </ul>

                        <a href="{{ route('encuentros.index') }}" class="btn btn-primary mt-3"><i
                                class="fas fa-arrow-circle-left"></i> Volver</a>
                        <a href="{{ route('encuentros.edit', $jugadorencuentro->id) }}"
                            class="btn btn-warning mt-3"><i class="fas fa-edit"></i> Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
