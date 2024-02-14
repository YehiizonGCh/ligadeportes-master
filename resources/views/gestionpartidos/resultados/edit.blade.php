@extends('adminlte::page')

@section('title', 'Editar Resultado')
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
                    <li class="breadcrumb-item active"><i class="fas fa-edit mr-2"></i>Editar Resultado</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text" ><b><img
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/128/4389/4389651.png') }}"
                                    title="Registro de Partido" alt="" width="40" height="40"
                                    class="mr-2" >EDITAR RESULTADO</b></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('resultados.update', $estadisticapartido->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="partidos_id"><i class="fas fa-gamepad"></i> Seleccionar Partido:</label>
                                        <select name="partidos_id" id="partidos_id" class="form-control text-center">
                                            <option value="" disabled>Selecciona un partido</option>
                                            @foreach ($partidos as $partido)
                                            <option value="{{ $partido->id }}"
                                                data-local="{{ $partido->equipolocal->nombre }}"
                                                data-visitante="{{ $partido->equipovisitante->nombre }}"
                                                {{ $estadisticapartido->partidos_id == $partido->id ? 'selected' : '' }}>
                                                {{ $partido->equipolocal->nombre }} vs
                                                {{ $partido->equipovisitante->nombre }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Campos para el equipo local -->
                                    <h4 class="text-center" style="color: #087a91"><i class="fas fa-futbol"></i> <b>EQUIPO LOCAL</b></h4>
                                    <div class="form-group">
                                        <label for="goles_local"><i class="fas fa-futbol"></i> Goles para el equipo local
                                            (<span id="nombre_local">Equipo Local</span>):</label>
                                        <input type="number" name="goles_local" id="goles_local" class="form-control"
                                            value="{{$estadisticapartido->goles_local}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="corners_local"><i class="fas fa-ruler-combined" style="color: #089178"></i> Corners para el equipo local
                                            (<span id="nombre_local_corners">Equipo Local</span>):</label>
                                        <input type="number" name="corners_local" id="corners_local" class="form-control"
                                            value="{{ $estadisticapartido->corners_local }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="faltas_local"><i class="fas fa-minus-circle" style="color: #915308"></i> Faltas para el equipo local
                                            (<span id="nombre_local_faltas">Equipo Local</span>):</label>
                                        <input type="number" name="faltas_local" id="faltas_local" class="form-control"
                                            value="{{ $estadisticapartido->faltas_local }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tarjetas_amarillas_local"><i class="fas fa-file" style="color: #cbc80b"></i> Tarjetas amarillas equipo local
                                            (<span id="nombre_local_amarillas">Equipo Local</span>):</label>
                                        <input type="number" name="tarjetas_amarillas_local" id="tarjetas_amarillas_local" class="form-control"
                                            value="{{ $estadisticapartido->tarjetas_amarillas_local }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tarjetas_rojas_local"><i class="fas fa-file" style="color: #910818"></i> Tarjetas rojas para el equipo local
                                            (<span id="nombre_local_rojas">Equipo Local</span>):</label>
                                        <input type="number" name="tarjetas_rojas_local" id="tarjetas_rojas_local" class="form-control"
                                            value="{{ $estadisticapartido->tarjetas_rojas_local }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Campos para el equipo visitante -->
                                    <h4 class="text-center" style="color: #087a91"><i class="fas fa-futbol"></i> <b>EQUIPO VISITANTE</b></h4>
                                    <div class="form-group">
                                        <label for="goles_visitante"><i class="fas fa-futbol"></i> Goles para el equipo
                                            visitante (<span id="nombre_visitante">Equipo Visitante</span>):</label>
                                        <input type="number" name="goles_visitante" id="goles_visitante"
                                            class="form-control" value="{{$estadisticapartido->goles_visitante}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="corners_visitante"><i class="fas fa-ruler-combined" style="color: #089178"></i> Corners para el equipo local
                                            (<span id="nombre_visitante_corners">Equipo Visitante</span>):</label>
                                        <input type="number" name="corners_visitante" id="corners_visitante" class="form-control"
                                            value="{{$estadisticapartido->corners_visitante}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="faltas_visitante"><i class="fas fa-minus-circle" style="color: #915308"></i> Faltas para el equipo local
                                            (<span id="nombre_visitante_faltas">Equipo Visitante</span>):</label>
                                        <input type="number" name="faltas_visitante" id="faltas_visitante" class="form-control"
                                            value="{{ $estadisticapartido->faltas_visitante }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tarjetas_amarillas_visitante"><i class="fas fa-file" style="color: #cbc80b"></i> Tarjetas amarillas equipo local
                                            (<span id="nombre_visitante_amarillas">Equipo Visitante</span>):</label>
                                        <input type="number" name="tarjetas_amarillas_visitante" id="tarjetas_amarillas_visitante" class="form-control"
                                            value="{{ $estadisticapartido->tarjetas_amarillas_visitante }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tarjetas_rojas_visitante"><i class="fas fa-file" style="color: #910818"></i> Tarjetas rojas para el equipo local
                                            (<span id="nombre_visitante_rojas">Equipo Visitante</span>):</label>
                                        <input type="number" name="tarjetas_rojas_visitante" id="tarjetas_rojas_visitante" class="form-control"
                                            value="{{ $estadisticapartido->tarjetas_rojas_visitante }}">
                                    </div>
                                </div>
                            </div>
                            {{-- boton actualizar --}}

                            <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Actualizar</button>
                            <a href="{{ route('resultados.index') }}" class="btn btn-secondary"><i class="fas fa-ban"></i>
                                Cancelar</a>
                        </form>
                    </div>
                    <script>
                        // Función para actualizar los nombres del equipo local y visitante
                        function actualizarNombresEquipos() {
                            var selectedOption = document.getElementById('partidos_id').options[document.getElementById('partidos_id').selectedIndex];
                            var nombreLocal = selectedOption.getAttribute('data-local');
                            var nombreVisitante = selectedOption.getAttribute('data-visitante');
                    
                            document.getElementById('nombre_local').innerText = nombreLocal;
                            document.getElementById('nombre_visitante').innerText = nombreVisitante;
                            document.getElementById('nombre_local_corners').innerText = nombreLocal;
                            document.getElementById('nombre_visitante_corners').innerText = nombreVisitante;
                            document.getElementById('nombre_local_faltas').innerText = nombreLocal;
                            document.getElementById('nombre_visitante_faltas').innerText = nombreVisitante;
                            document.getElementById('nombre_local_amarillas').innerText = nombreLocal;
                            document.getElementById('nombre_visitante_amarillas').innerText = nombreVisitante;
                            document.getElementById('nombre_local_rojas').innerText = nombreLocal;
                            document.getElementById('nombre_visitante_rojas').innerText = nombreVisitante;
                        }
                    
                        // Llamada a la función al cargar la página
                        actualizarNombresEquipos();
                    
                        // Asegura que el DOM está completamente cargado antes de ejecutar el script
                        document.addEventListener('DOMContentLoaded', function() {
                            // Cambiar el nombre del equipo local y visitante al seleccionar un partido
                            document.getElementById('partidos_id').addEventListener('change', function () {
                                // Llamada a la función cuando cambia la selección
                                actualizarNombresEquipos();
                            });
                        });
                    </script>
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection
