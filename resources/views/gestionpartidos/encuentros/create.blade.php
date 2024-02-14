@extends('adminlte::page')

@section('title', 'Resultados de partidos')
@section('plugins.Sweetalert2', true)
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
                    <li class="breadcrumb-item active">Registro de Encuentros Jugador</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text"><b><img
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/512/3048/3048379.png') }}"
                                    title="Registro de Partido" alt="" width="40" height="40"
                                    class="mr-2">REGISTRAR JUGADOR QUE JUGÓ</b></h3>
                        <div class="card-body">

                            <form action="{{ route('encuentros.store') }}" method="POST">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="partidos_id">Partido:</label>
                                            <select name="partidos_id" id="partidos_id" class="form-control">
                                                <option value="" disabled selected>Seleccione un partido</option>
                                                {{-- Opciones de partidos --}}
                                                @foreach ($partidos as $partido)
                                                    <option value="{{ $partido->id }}">
                                                        {{ $partido->equipolocal->nombre }} 
                                                        {{ $partido->estadisticaspartidos->isNotEmpty() ? "(" . $partido->estadisticaspartidos->first()->goles_local . ")" : "(0)" }} vs
                                                        {{ $partido->estadisticaspartidos->isNotEmpty() ? "(" . $partido->estadisticaspartidos->first()->goles_visitante . ")" : "(0)" }}

                                                        {{ $partido->equipovisitante->nombre }} >>>
                                                        {{ $partido->fecha_partido }}--{{ $partido->hora_partido }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('partidos_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Selecciona el equipo:</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="equipo_seleccionado"
                                                    id="equipo_local" value="local" checked>
                                                <label class="form-check-label" for="equipo_local">
                                                    Equipo Local
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="equipo_seleccionado"
                                                    id="equipo_visitante" value="visitante">
                                                <label class="form-check-label" for="equipo_visitante">
                                                    Equipo Visitante
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jugadores_id">Jugador:</label>
                                            <select name="jugadores_id" id="jugadores_id" class="form-control">
                                                <option value="" disabled selected>Seleccione un jugador</option>
                                                {{-- Los jugadores se cargarán dinámicamente según el partido y el equipo seleccionado --}}
                                            </select>
                                            @error('jugadores_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="titular">Titular?:</label>
                                            <select name="titular" id="titular" class="form-control">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Si-Titular</option>
                                                <option value="0">No-Suplente</option>
                                            </select>

                                            @error('titular')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="asistencias">Asistencias:</label>
                                            <input type="number" name="asistencias" id="asistencias" class="form-control"
                                                value="{{ old('asistencias', 0) }}" value="0" min="0"
                                                max="10">
                                            @error('asistencias')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="amarillas">Tarjetas Amarillas:</label>
                                            <input type="number" name="amarillas" id="amarillas" class="form-control"
                                                value="{{ old('amarillas', 0) }}" value="0" min="0"
                                                max="1">
                                            @error('amarillas')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="rojas">Tarjetas Rojas:</label>
                                            <input type="number" name="rojas" id="rojas" class="form-control"
                                                value="{{ old('rojas', 0) }}" value="0" min="0" max="1">
                                            @error('rojas')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="observacion_targeta_amarilla">Observacion por la targeta
                                                amarilla:</label>
                                            <textarea name="observacion_targeta_amarilla" id="observacion_targeta_amarilla" cols="30" rows="3"
                                                class="form-control" value="{{ old('observacion_targeta_amarilla') }}"></textarea>
                                            @error('observacion_targeta_amarilla')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="observacion_targeta_roja">Observacion por la trageta roja:</label>
                                            <textarea name="observacion_targeta_roja" id="observacion_targeta_roja" cols="30" rows="3"
                                                class="form-control" value="{{ old('observacion_targeta_roja') }}"></textarea>
                                            @error('observacion_targeta_roja')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="goles">Total de Goles:</label>
                                            <input type="number" name="goles" id="goles" class="form-control"
                                                value="{{ old('goles', 0) }}" min="0" max="10">
                                            @error('goles')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="autogoles">Total de Autogol:</label>
                                            <input type="number" name="autogoles" id="autogoles" class="form-control"
                                                value="{{ old('autogoles', 0) }}"  min="0"
                                                max="10">
                                            @error('autogoles')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row col-md-12">
                                        <div class="col-md-12">
                                            <div id="goles-details">

                                            </div>
                                            <div class="form-group">
                                                <label for="observacion_goles">Observacion por el gol:</label>
                                                <textarea name="observacion_goles" id="observacion_goles" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row col-md-12">
                                        <div class="col-md-12">
                                            <div id="autogoles-details"></div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                <a href="{{ route('encuentros.index') }}" class="btn btn-secondary"><i class="fas fa-ban"></i>
                                    Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
    @section('js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // se muestran los campos goles para llenar
            document.getElementById('goles').addEventListener('input', function() {
                // Limpia los detalles anteriores
                document.getElementById('goles-details').innerHTML = '';

                const totalGoles = parseInt(this.value);

                // Crea campos de entrada para cada gol
                for (let i = 1; i <= totalGoles; i++) {
                    const div = document.createElement('div');
                    div.className = 'form-group';

                    const label = document.createElement('label');
                    label.textContent = `Minuto del Gol ${i}:`;

                    const input = document.createElement('input');
                    input.type = 'number';
                    input.name = `minuto_gol[${i}]`;
                    input.className = 'form-control';
                    input.required = true;

                    div.appendChild(label);
                    div.appendChild(input);

                    document.getElementById('goles-details').appendChild(div);
                }
            });
            // fin

            // Inicio Cuando cambia el partido seleccionado, llama a la función para cargar los jugadores
            document.getElementById('partidos_id').addEventListener('change', function() {
                var partidoId = this.value;

                // Luego, llama a la función para cargar los jugadores según el partido y el equipo seleccionado
                loadPlayers(partidoId);
            });

            document.getElementsByName('equipo_seleccionado').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    // Cuando cambia el equipo seleccionado, llama a la función para cargar los jugadores
                    var partidoId = document.getElementById('partidos_id').value;
                    loadPlayers(partidoId);
                });
            });

            function loadPlayers(partidoId) {
                // Hacer una llamada AJAX para obtener los jugadores del partido y equipo seleccionado
                var equipoSeleccionado = document.querySelector('input[name="equipo_seleccionado"]:checked').value;

                fetch(`/api/jugadores-por-partido/${partidoId}/${equipoSeleccionado}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al obtener los jugadores');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Rellenar el select de jugadores con los nombres de los jugadores relevantes
                        var jugadoresSelect = document.getElementById('jugadores_id');
                        jugadoresSelect.innerHTML = ''; // Limpiar el select

                        // Agregar la opción "Seleccione un jugador" antes de los jugadores reales
                        var defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        defaultOption.textContent = 'Seleccione un jugador';
                        jugadoresSelect.appendChild(defaultOption);

                        data.forEach(jugador => {
                            var option = document.createElement('option');
                            option.value = jugador.id;
                            option.textContent =
                                `${jugador.nombres} ${jugador.apellido_paterno} ${jugador.apellido_materno} (${jugador.posicion})`;
                            jugadoresSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al obtener los jugadores:', error);
                        // Aquí podrías mostrar un mensaje de error al usuario
                    });
            }

            // fin de la funcion de cargar jugadores


            @if (session('errorjugador'))
                Swal.fire({
                    title: 'Error',
                    text: '{{ session('errorjugador') }}',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                });
            @endif






            @if (session('errorgol'))
                Swal.fire({
                    title: 'Error',
                    text: '{{ session('errorgol') }}',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                });
            @endif

            @if (session('errorautogol'))
                Swal.fire({
                    title: 'Error',
                    text: '{{ session('errorautogol') }}',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                });
            @endif

            document.getElementById('autogoles').addEventListener('input', function() {
                // Limpia los detalles anteriores
                document.getElementById('autogoles-details').innerHTML = '';
                const totalGoles = parseInt(this.value);

                // Crea campos de entrada para cada gol
                for (let i = 1; i <= totalGoles; i++) {
                    const div = document.createElement('div');
                    div.className = 'form-group';

                    const label = document.createElement('label');
                    label.textContent = `Minuto del Autogol ${i}:`;

                    const input = document.createElement('input');
                    input.type = 'number';
                    input.name = `minuto_autogol[${i}]`;
                    input.className = 'form-control';
                    input.required = true;

                    div.appendChild(label);
                    div.appendChild(input);

                    document.getElementById('autogoles-details').appendChild(div);
                }
            });
        </script>
    @endsection
