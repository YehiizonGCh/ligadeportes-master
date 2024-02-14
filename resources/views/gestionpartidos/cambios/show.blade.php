@extends('adminlte::page')

@section('title', 'Detalles del Cambio de Jugador')
@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cambios.index') }}"><i
                                class="fas fa-user-clock mr-2"></i>Cambios</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-eye mr-2"></i>Detalles del Cambio de Jugador</li>
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
                            <img src="{{ asset('https://cdn-icons-png.flaticon.com/512/3101/3101003.png') }}"
                            title="Cambio de Jugador" alt="" width="40" height="40" class="mr-2">
                            <b>DETALLE DEL CAMBIO DE JUGADOR</b>
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-5">
                                <img src="{{ asset($jugadorcambio->partido->equipolocal->club->logo) }}" alt=""
                                    width="100" height="100" class="mr-2">
                                <h3 class="card-text "><b>{{ $jugadorcambio->partido->equipolocal->nombre }}</b></h3>
                            </div>
                            <div class="col-md-2">
                                <h3 class="card-text ">
                                    <b>{{ $jugadorcambio->partido->estadisticaspartidos->isNotEmpty() ? $jugadorcambio->partido->estadisticaspartidos->first()->goles_local : 0 }}
                                        -
                                        {{ $jugadorcambio->partido->estadisticaspartidos->isNotEmpty() ? $jugadorcambio->partido->estadisticaspartidos->first()->goles_visitante : 0 }}</b>
                                </h3>
                            </div>

                            <div class="col-md-5">
                                <img src="{{ asset($jugadorcambio->partido->equipolocal->club->logo) }}" alt=""
                                    width="100" height="100" class="mr-2">
                                <h3 class="card-text "><b>{{ $jugadorcambio->partido->equipovisitante->nombre }}</b></h3>
                            </div>
                        </div>
                    </div>       

                    <div class="card-body">
                        <h4>Detalles del Cambio de Jugador</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Partido:</strong>
                                {{ $jugadorcambio->partido->equipolocal->nombre }} vs {{ $jugadorcambio->partido->equipovisitante->nombre }}
                            </li>
                            {{-- fecha --}}
                            <li class="list-group-item">
                                <strong>Fecha del Partido:</strong>
                                {{ $jugadorcambio->partido->fecha_partido }} >>>HORA: {{ $jugadorcambio->partido->hora_partido }}
                            <li class="list-group-item">
                                <strong><i class="fas fa-arrow-circle-up" style="color: #055b3e"></i> Jugador que Entra:</strong>
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

                        <a href="{{ route('cambios.index') }}" class="btn btn-primary mt-3"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                        <a href="{{ route('cambios.edit', $jugadorcambio->id) }}" class="btn btn-warning mt-3"><i class="fas fa-pencil-alt"></i> Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
