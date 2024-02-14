@extends('adminlte::page')

@section('title', 'Torneos')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('torneos.index') }}"><i
                                class="fas fa-shapes mr-2"></i>Torneos</a></li>
                    <li class="breadcrumb-item active">Registro de Torneos </li>
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
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/512/3363/3363488.png') }}"
                                    title="Registro de Torneo" alt="" width="40" height="40"
                                    class="mr-2">CREAR TORNEO</b></h3>
                        <div class="card-body ">
                            <form method="POST" action="{{ route('torneos.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ old('nombre') }}">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="abreviatura">Abreviatura</label>
                                            <input type="text" name="abreviatura" id="abreviatura" class="form-control"
                                                value="{{ old('abreviatura') }}">
                                            @foreach ($errors->get('abreviatura') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="temporada" class="form-label">Temporada</label>
                                            <input type="text" name="temporada" id="temporada" class="form-control"
                                                value="{{ old('temporada') }}">
                                            @foreach ($errors->get('temporada') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion</label>
                                            <textarea type="text" name="descripcion" id="descripcion" class="form-control" rows="7" style="resize: none;"
                                                value="{{ old('descripcion') }}"></textarea>
                                            @foreach ($errors->get('descripcion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <div class="card border-primary">
                                                <div class="card-body" style="text-align: center;">
                                                    <label for="logo" id="icon-image" class="btn btn-primary"
                                                        style="display: block; background-color: #087a91;"><i
                                                            class="fas fa-image"></i></label>
                                                    <span id="icon-cerrar"></span>
                                                    <input id="logo" class="d-none" type="file" name="logo"
                                                        onchange="previsualizacionImage(event)" accept="image/*">
                                                    @foreach ($errors->get('logo') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                    <input type="hidden" id="foto_actual" name="foto_actual"
                                                        value="{{ old('foto_actual') }}">
                                                    <img id="img-preview" style="max-width: 100%; max-height: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_inicio"> Fecha Inicio</label>
                                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                                value="{{ old('fecha_inicio') }}">
                                            @foreach ($errors->get('fecha_inicio') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_fin"> Fecha Cierre</label>
                                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                                                value="{{ old('fecha_fin') }}">
                                            @foreach ($errors->get('fecha_fin') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="from-group">
                                            <label for="ligas_id">ligas</label>
                                            <select name="ligas_id" id="ligas_id" class="form-control">
                                                <option value="">Seleccione</option>
                                                @foreach ($ligas as $liga)
                                                    <option value="{{ $liga->id }}">{{ $liga->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @foreach ($errors->get('ligas_id') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                            Guardar</button>
                                        <a href="{{ route('torneos.index') }}" class="btn btn-secondary"><i
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
    <script>
        // Cuando se carga la página, verifica si hay una imagen previamente seleccionada
        window.onload = function() {
            var foto_actual = document.getElementById('foto_actual').value;
            if (foto_actual) {
                var imgPreview = document.getElementById('img-preview');
                imgPreview.setAttribute('src', foto_actual);
            }
        };

        function previsualizacionImage(event) {
            var input = event.target;
            var imgPreview = document.getElementById('img-preview');
            var iconCerrar = document.getElementById('icon-cerrar');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    imgPreview.setAttribute('src', e.target.result);
                    iconCerrar.innerHTML =
                        '<i class="fas fa-times-circle text-danger" onclick="borrarPrevisualizacion()"></i>';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                imgPreview.src = '';
                iconCerrar.innerHTML = '';
            }
        }

        function borrarPrevisualizacion() {
            var imgPreview = document.getElementById('img-preview');
            var iconCerrar = document.getElementById('icon-cerrar');
            var input = document.getElementById('logo');

            imgPreview.src = '';
            iconCerrar.innerHTML = '';
            input.value = ''; // Esto limpia el valor del input file
        }
    </script>

@stop
