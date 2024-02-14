@extends('adminlte::page')

@section('title', 'Partidos')
@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('partidos.index') }}"><i
                                class="fas fa-users mr-2"></i>Partido</a></li>
                    <li class="breadcrumb-item active">Registro de Partido</li>
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
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/512/4781/4781124.png') }}"
                                    title="Registro de Partido" alt="" width="40" height="40"
                                    class="mr-2">REGISTRAR PARTIDO</b></h3>
                        <div class="card-body">
                            <form action="{{ route('partidos.store') }}" method="POST">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categorys_id">Categoría</label>
                                            <select id="categorys_id" name="categorys_id" class="form-control"
                                                value="{{ old('categorys_id') }}">
                                                <option value="" disabled selected>Selecciona una categoría</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">
                                                        {{ $categoria->nombre }}
                                                    </option>
                                                @endforeach
                                                @foreach ($errors->get('categorys_id') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="equipos_id">Equipo Local</label>
                                            <select id="equipos_id" name="equipos_id" class="form-control">
                                                <!-- Opciones de equipos locales (se actualizarán dinámicamente) -->
                                            </select>
                                            @foreach ($errors->get('equipos_id') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="equipos_id1">Equipo Visitante</label>
                                            <select id="equipos_id1" name="equipos_id1" class="form-control">
                                                <!-- Opciones de equipos visitantes (se actualizarán dinámicamente) -->
                                            </select>
                                            @foreach ($errors->get('equipos_id1') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fecha_partido"> Fecha
                                                Partido</label>
                                            <input type="date" name="fecha_partido" id="fecha_partido"
                                                class="form-control" value="{{ old('fecha_partido') }}">
                                            @foreach ($errors->get('fecha_partido') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="hora_partido">Hora Partido</label>
                                            <input type="time" name="hora_partido" id="hora_partido" class="form-control"
                                                value="{{ old('hora_partido') }}">
                                            @foreach ($errors->get('hora_partido') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estadios_id">Estadio</label>
                                            <select name="estadios_id" id="estadios_id" class="form-control"
                                                value="{{ old('estadios_id') }}">
                                                <option value="" disabled selected>Selecciona un estadio</option>
                                                @foreach ($estadios as $estadio)
                                                    <option value="{{ $estadio->id }}">
                                                        {{ $estadio->nombre }}
                                                    </option>
                                                @endforeach
                                                @foreach ($errors->get('estadios_id') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="arbitros_id">Arbitro</label>
                                            <select name="arbitros_id" id="arbitros_id" class="form-control"
                                                value="{{ old('arbitros_id') }}">
                                                <option value="" disabled selected>Selecciona un arbitro</option>
                                                @foreach ($arbitros as $arbitro)
                                                    <option value="{{ $arbitro->id }}">
                                                        {{ $arbitro->nombre }} {{ $arbitro->apellido }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ligas_id">Liga</label>
                                            <select name="ligas_id" id="ligas_id" class="form-control"
                                                value="{{ old('ligas_id') }}">
                                                <option value="" disabled selected>Selecciona una liga</option>
                                                @foreach ($ligas as $liga)
                                                    <option value="{{ $liga->id }}">
                                                        {{ $liga->nombre }}
                                                    </option>
                                                @endforeach
                                                @foreach ($errors->get('ligas_id') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lugar">Lugar</label>
                                            <input type="text" name="lugar" id="lugar" class="form-control"
                                                value="{{ old('lugar') }}">
                                            @foreach ($errors->get('lugar') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="observacion">Observación</label>
                                            <input type="text" name="observacion" id="observacion" class="form-control"
                                                value="{{ old('observacion') }}">
                                            @foreach ($errors->get('observacion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                            Guardar</button>
                                        <a href="{{ route('partidos.index') }}" class="btn btn-secondary"><i
                                                class="fas fa-ban"></i> Cancelar</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            // Actualizar dinámicamente las opciones de equipos al cambiar la categoría
            $(document).ready(function() {
                $('#categorys_id').change(function() {
                    var categoriaId = $(this).val();

                    // Realiza una solicitud AJAX para obtener los equipos relacionados con la categoría
                    $.ajax({
                        url: '/obtener-equipos-por-categoria/' + categoriaId,
                        type: 'GET',
                        success: function(data) {
                            // Actualiza las opciones de equipo local y visitante
                            actualizarOpcionesEquipos(data, 'equipos_id');
                            actualizarOpcionesEquipos(data, 'equipos_id1');
                        },
                        error: function() {
                            console.log('Error al obtener los equipos');
                        }
                    });
                });

                function actualizarOpcionesEquipos(equipos, selectId) {
                    var selectEquipo = $('#' + selectId);
                    selectEquipo.empty();

                    // Agrega las nuevas opciones de equipos
                    equipos.forEach(function(equipo) {
                        selectEquipo.append('<option value="' + equipo.id + '">' + equipo.nombre + '</option>');
                    });
                }
            });
        </script>
    @endsection
