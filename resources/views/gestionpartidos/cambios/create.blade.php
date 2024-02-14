@extends('adminlte::page')

@section('title', 'Cambios de Jugadores')
@section('plugins.Sweetalert2', true)
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
                    <li class="breadcrumb-item active">Registro de Cambios Jugador</li>
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
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/512/3101/3101003.png') }}"
                                    title="Registro de Partido" alt="" width="40" height="40"
                                    class="mr-2">REGISTRAR CAMBIOS QUE UBIERON EN EL PARTIDO</b></h3>
                        <div class="card-body">

                            <form action="{{ route('cambios.store') }}" method="POST">
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jugador_entra_id"><i class="fas fa-arrow-circle-up" style="color: #055b3e"></i> Jugador que
                                                entra: </label>
                                            <select name="jugador_entra_id" id="jugador_entra_id" class="form-control">
                                                <option value="" disabled selected>Seleccione un jugador</option>
                                                {{-- Opciones de jugadores --}}
                                                {{-- Se rellena con AJAX --}}
                                            </select>
                                            @error('jugador_entra_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jugador_sale_id"><i class="fas fa-arrow-circle-down" style="color: rgb(91, 5, 27)"></i> Jugador que
                                                sale: </label>
                                            <select name="jugador_sale_id" id="jugador_sale_id" class="form-control">
                                                <option value="" disabled selected>Seleccione un jugador</option>
                                                {{-- Opciones de jugadores --}}
                                                {{-- Se rellena con AJAX --}}
                                            </select>
                                            @error('jugador_sale_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="minuto_cambio" ><i class="fas fa-clock" style="color: #28916e"></i> Minuto del cambio:</label>
                                            <input type="number" name="minuto_cambio" id="minuto_cambio" class="form-control"
                                                placeholder="Ingrese el minuto del cambio" value="{{ old('minuto_cambio') }}" min="0" max="150">
                                            @error('minuto_cambio')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observacion_cambio"><i class="fas fa-comment-dots" style="color: #28916e"></i> Observación del cambio:</label>
                                            <textarea name="observacion_cambio" id="observacion_cambio" cols="30" rows="3"
                                                class="form-control" placeholder="Ingrese la observacion del cambio"
                                                value="{{ old('observacion_cambio') }}"></textarea>
                                            @error('observacion_cambio')

                                                <small class="text-danger">{{ $message }}</small>   
                                            @enderror                                       
                                        
                                        
                                        </div>
                                    </div>
                                </div>

                                    
                                    

                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                    Guardar</button>
                                <a href="{{ route('cambios.index') }}" class="btn btn-secondary"><i class="fas fa-ban"></i>
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
        document.getElementById('partidos_id').addEventListener('change', function() {
            var partidoId = this.value;
            var equipoSeleccionado = document.querySelector('input[name="equipo_seleccionado"]:checked').value;

            if (partidoId && equipoSeleccionado) {
                loadPlayers(partidoId, equipoSeleccionado);
            }
        });

        document.getElementsByName('equipo_seleccionado').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var partidoId = document.getElementById('partidos_id').value;
                var equipoSeleccionado = this.value;

                if (partidoId && equipoSeleccionado) {
                    loadPlayers(partidoId, equipoSeleccionado);
                }
            });
        });

        function loadPlayers(partidoId, equipoSeleccionado) {
            fetch(`/api/jugadores-por-partido/${partidoId}/${equipoSeleccionado}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los jugadores');
                    }
                    return response.json();
                })
                .then(data => {
                    // Rellenar el select de jugadores que entra
                    var jugadorEntraSelect = document.getElementById('jugador_entra_id');
                    jugadorEntraSelect.innerHTML = '';
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    defaultOption.textContent = 'Seleccione un jugador';
                    jugadorEntraSelect.appendChild(defaultOption);

                    // Rellenar el select de jugadores que sale
                    var jugadorSaleSelect = document.getElementById('jugador_sale_id');
                    jugadorSaleSelect.innerHTML = '';
                    jugadorSaleSelect.appendChild(defaultOption.cloneNode(true)); // Reutiliza el mismo defaultOption

                    data.forEach(jugador => {
                        var option = document.createElement('option');
                        option.value = jugador.id;
                        option.textContent =
                            `${jugador.nombres} ${jugador.apellido_paterno} ${jugador.apellido_materno} (${jugador.posicion})`;
                        jugadorEntraSelect.appendChild(option);

                        // Clona el mismo option para el jugador que sale
                        jugadorSaleSelect.appendChild(option.cloneNode(true));
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los jugadores:', error);
                    // Aquí podrías mostrar un mensaje de error al usuario
                });

            // Agregar la validación al cambio de jugadores
            document.getElementById('jugador_entra_id').addEventListener('change', function() {
                validateSelectedPlayers();
            });

            document.getElementById('jugador_sale_id').addEventListener('change', function() {
                validateSelectedPlayers();
            });

            function validateSelectedPlayers() {
                var jugadorEntraSelect = document.getElementById('jugador_entra_id');
                var jugadorSaleSelect = document.getElementById('jugador_sale_id');

                var jugadorEntraValue = jugadorEntraSelect.value;
                var jugadorSaleValue = jugadorSaleSelect.value;

                if (jugadorEntraValue === jugadorSaleValue) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El jugador que entra no puede ser el mismo que el jugador que sale.'
                        // Puedes personalizar más la alerta según tus necesidades
                    });

                    // Puedes agregar tu lógica para manejar el error, como desmarcar uno de los campos.
                }
            }
        }
    </script>

    @if(session('errorcambio'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('errorcambio') }}'
                // Puedes personalizar más la alerta según tus necesidades
            });
        </script>
    @endif
@endsection

