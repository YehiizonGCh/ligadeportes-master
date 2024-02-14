@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('equipos.index') }}"><i
                                class="fas fa-users mr-2"></i>Equipos</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-edit mr-2"></i>Editar Equipos</li>
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
                        <h3 class="card-text"><b><img
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/512/2257/2257060.png') }}"
                                    title="Equipo" alt="" width="40" height="40" class="mr-2">EDITAR
                                EQUIPO</b></h3>

                        <div class="card-body ">
                            <form method="POST" action="{{ route('equipos.update', $equipo->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Método para la actualización -->


                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="clubs_id">Club</label>
                                            <select name="clubs_id" id="clubs_id" class="form-control">
                                                <option value="" disabled>Selecciona un club</option>
                                                @foreach ($clubs as $club)
                                                    <option value="{{ $club->id }}"
                                                        {{ old('clubs_id', $equipo->clubs_id) == $club->id ? 'selected' : '' }}>
                                                        {{ $club->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categorys_id">Categoría</label>
                                            <select name="categorys_id" id="categorys_id" class="form-control">
                                                <option value="" disabled>Selecciona una categoría</option>
                                                @foreach ($categorias as $id => $nombre)
                                                    <option value="{{ $id }}"
                                                        {{ old('categorys_id', $equipo->categorys_id) == $id ? 'selected' : '' }}>
                                                        {{ $nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ old('nombre', $equipo->nombre) }}">
                                            @error('nombre')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="representante">Representante</label>
                                            <input type="text" name="representante" id="representante"
                                                class="form-control"
                                                value="{{ old('representante', $equipo->representante) }}">
                                            @error('representante')
                                                <span class="text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entrenadors_id">Entrenador</label>
                                            <select name="entrenadors_id" id="entrenadors_id" class="form-control">
                                                <option value="" disabled>Selecciona un entrenador</option>
                                                @foreach ($entrenadores as $entrenador)
                                                    <option value="{{ $entrenador->id }}"
                                                        {{ old('entrenadors_id', $equipo->entrenadors_id) == $entrenador->id ? 'selected' : '' }}>
                                                        {{ $entrenador->nombre }} {{ $entrenador->apellido }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-warning"><i
                                                class="fas fa-save"></i> Guardar</button>
                                        <a href="{{ route('equipos.index') }}" class="btn btn-secondary"><i
                                                class="fas fa-times"></i> Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            // Almacena el club actual del registro
            var selectedClubId = $('#clubs_id').val();
            var selectedCategoryId = '{{ old('categorys_id', $equipo->categorys_id) }}';

            // Carga automáticamente las categorías basadas en el club seleccionado en la página de edición
            if (selectedClubId) {
                obtenerCategoriasPorClub(selectedClubId, selectedCategoryId);
            }

            // Cuando se selecciona un club
            $('#clubs_id').on('change', function() {
                var clubId = $(this).val();
                if (clubId) {
                    // Actualiza la variable con el club seleccionado
                    selectedClubId = clubId;

                    // Realiza una solicitud AJAX para obtener las categorías asociadas al club
                    obtenerCategoriasPorClub(clubId, null);
                }
            });

            function obtenerCategoriasPorClub(clubId, selectedCategoryId) {
                $.ajax({
                    type: 'GET',
                    url: '/obtener-categorias-por-club/' + clubId,
                    success: function(data) {
                        // Limpiar y rellenar el campo de selección de categorías
                        $('#categorys_id').empty();

                        var firstOption = '<option value="" disabled>Selecciona una categoría</option>';

                        if (selectedCategoryId) {
                            // Si hay una categoría seleccionada previamente, agrégala como primera opción
                            firstOption = '<option value="' + selectedCategoryId + '">' + data
                                .categorias[selectedCategoryId] + '</option>';
                        }

                        $('#categorys_id').append(firstOption);

                        // Acceder a las propiedades del objeto y agregar las opciones de categoría al campo de selección

                        $.each(data.categorias, function(id, nombre) {
                            if (id != selectedCategoryId) {
                                $('#categorys_id').append('<option value="' + id + '">' +
                                    nombre + '</option>');

                            }
                        });
                    }
                });
            }
        });
    </script>




@stop
