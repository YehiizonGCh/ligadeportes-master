@extends('adminlte::page')
 
@section('title', 'Cambios de partidos')
@section('plugins.Sweetalert2', true)
@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-user-clock mr-2"></i>Cambios Jugadores</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text"><b> CAMBIOS DURANTE EL PARTIDO</b></h3>
                        <div class="card-body">
                            <h5 class="m-0 float-left">
                                @can('crear-jugador-cambio')
                                    <a href="{{ route('cambios.create') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i> Nuevo</a> 
                                @endcan

                                    <a href="{{ route('generar.pdf.jugadorcambios') }}" class="btn btn-danger"><i
                                        class="fas fa-file-pdf"></i> PDF</a>
                            </h5>
                            <br><br>

                            <form action="{{ route('cambios.index') }}" method="GET">
                                @csrf
                                <div class="input-group float-right">
                                    <input type="text" class="form-control" name="texto" placeholder="Buscar..." value="{{ $texto }}">
                                    <input type="date" class="form-control" name="fecha_inicial" id="fecha_inicial" value="{{ $fecha_inicial }}">
                                    <input type="date" class="form-control" name="fecha_final" id="fecha_final" value="{{ $fecha_final }}">
                            
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <br><br>

                            <div class="mt-2 table-responsive text-center ">
                                <table class="table  table-hover table-borderless shadow p-2 mb-5 bg-body rounded "
                                    style="border-radius: 10px; overflow: hidden;">
                                    <thead class="text-white" style="background-color:#2fb98b">
                                        <tr>
                                            <th>Jugador Entra</th>
                                            <th>Jugador Sale</th>
                                            <th>Partido</th>
                                            <th>Fecha Partido</th>
                                            <th>Categoria</th>                                            
                                            <th>Acciones</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($jugadorcambios) <= 0)
                                            <tr>
                                                <td colspan="7">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach ($jugadorcambios as $jugadorcambio)
                                                <tr>
                                                    
                                                    {{-- <td> {{ $partido->equipo_local }} vs {{ $partido->equipo_visita }}</td> --}}
                                                    <td><i class="fas fa-arrow-circle-up" style="color: #055b3e"></i>
                                                        {{ $jugadorcambio->jugadorentra->nombres }} {{ $jugadorcambio->jugadorentra->apellido_paterno }} {{ $jugadorcambio->jugadorentra->apellido_materno }}</td>
                                                    <td><i class="fas fa-arrow-circle-down" style="color: rgb(91, 5, 27)"></i>
                                                        {{ $jugadorcambio->jugadorsale->nombres }} {{ $jugadorcambio->jugadorsale->apellido_paterno }} {{ $jugadorcambio->jugadorsale->apellido_materno }}</td>

                                                    <td><img src="{{ asset($jugadorcambio->partido->equipolocal->club->logo) }}"
                                                            width="30" height="30"
                                                            style="border-radius: 50%; border: 2px solid rgb(177, 190, 188);"
                                                            class="mr-2">
                                                        {{ $jugadorcambio->partido->estadisticaspartidos->isNotEmpty() ? $jugadorcambio->partido->estadisticaspartidos->first()->goles_local : 0 }} -
                                                        {{ $jugadorcambio->partido->estadisticaspartidos->isNotEmpty() ? $jugadorcambio->partido->estadisticaspartidos->first()->goles_visitante : 0 }}
                                                        <img src="{{ asset($jugadorcambio->partido->equipovisitante->club->logo) }}"
                                                        width="30" height="30"
                                                        style="border-radius: 50%; border: 2px solid rgb(177, 190, 188);"
                                                        class="mr-2">
                                                    </td>

                                                    <td class="text-center">
                                                        {{ $jugadorcambio->partido->fecha_partido }} <br>
                                                        Hora: {{ $jugadorcambio->partido->hora_partido }}</td>
                                                    <td> {{ $jugadorcambio->partido->categoria->nombre }}</td>
                                                    

                                                    <td>
                                                        @can('editar-jugador-cambio')
                                                            <a href="{{ route('cambios.edit', $jugadorcambio->id) }}"
                                                                class="btn btn-warning btn-sm" title="Editar partido">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        @endcan

                                                        @can('ver-jugador-cambio')
                                                            <a href="{{ route('cambios.show', $jugadorcambio->id) }}"
                                                                class="btn btn-info btn-sm" title="Ver partido">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan                                                       

                                                    </td>


                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $jugadorcambios->appends(['texto' => "$texto"]) }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    @include('footer')
@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('create') == 'Cambio registrado correctamente')
        <script>
            Swal.fire(
                'Registrado!',
                'Se Registró correctamente.',
                'success'
            )
        </script>
    @endif



    @if (session('update') == 'Cambio actualizado correctamente')
        {{-- validar que se hallan echo cambios  sino que muestre no se isieron cambios --}}
        <script>
            Swal.fire(
                'Actualizado!',
                'Se Actualizó correctamente.',
                'success'
            )
        </script>
    @endif
    





@stop
