@extends('adminlte::page')

@section('title', 'Equipo')
 
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
                    <li class="breadcrumb-item active">Registro de Equipos</li>
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
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/512/2257/2257060.png') }}"
                                    title="Registro de Equipo" alt="" width="40" height="40"
                                    class="mr-2">CREAR EQUIPO</b></h3>
                        <div class="card-body ">
                            <form method="POST" action="{{ route('equipos.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="clubs_id">Club</label>
                                            <select name="clubs_id" id="clubs_id" class="form-control"
                                                value="{{ old('clubs_id') }}">
                                                <option value="" disabled selected>Selecciona un club</option>
                                                @foreach ($clubs as $club)
                                                    <option value="{{ $club->id }}">{{ $club->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Categoria</label>
                                            <select name="categorys_id" id="categorys_id" class="form-control"
                                                value="{{ old('categorys_id') }}">
                                                <option value="" disabled selected>Selecciona una categoría</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ old('nombre') }}">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Representante</label>
                                            <input type="text" name="representante" id="representante"
                                                class="form-control" value="{{ old('representante') }}">
                                            @foreach ($errors->get('representante') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entrenadors_id">Entrenador</label>
                                            <select name="entrenadors_id" id="entrenadors_id" class="form-control"
                                                value="{{ old('entrenadors_id') }}">
                                                <option value="" disabled selected>Selecciona un entrenador</option>
                                                @foreach ($entrenadores as $entrenador)
                                                    <option value="{{ $entrenador->id }}">
                                                        {{ $entrenador->nombre }} {{ $entrenador->apellido }}
                                                    </option>
                                                @endforeach
                                            </select>


                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                            Guardar</button>
                                        <a href="{{ route('equipos.index') }}" class="btn btn-secondary"><i
                                                class="fas fa-ban"></i> Cancelar</a>
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
            // Cuando se selecciona un club
            // Cuando se selecciona un club
            $('#clubs_id').on('change', function() {
                var clubId = $(this).val();
                if (clubId) {
                    // Realiza una solicitud AJAX para obtener las categorías asociadas al club
                    $.ajax({
                        type: 'GET',
                        url: '/obtener-categorias-por-club/' + clubId,
                        success: function(data) {
                            // Limpia el campo de selección de categorías
                            $('#categorys_id').empty();
                            $('#categorys_id').append(
                                '<option value="" disabled selected>Selecciona una categoría</option>'
                            );

                            // Accede a las propiedades del objeto y agrega las opciones de categoría al campo de selección
                            $.each(data.categorias, function(id, nombre) {
                                $('#categorys_id').append('<option value="' + id +
                                    '">' + nombre + '</option>');
                            });


                        }
                    });
                } else {
                    // Limpia el campo de selección de categorías si no se selecciona un club
                    $('#categorys_id').empty();
                    $('#categorys_id').append(
                        '<option value="" disabled selected>Selecciona una categoría</option>');
                    //  $('#torneo_id').val('')
                }
            });


        });
    </script>


@stop
