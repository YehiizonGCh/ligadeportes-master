@extends('adminlte::page')

@section('title', 'Entrenadores')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('entrenadores.index') }}"><i
                                class="fas fa-chalkboard-teacher mr-2"></i>Entrenadores</a></li>
                    <li class="breadcrumb-item active">Registro de Entrenadores</li>
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
                        <h3 class="card-text"><b><img src="{{ asset('https://cdn-icons-png.flaticon.com/512/2396/2396126.png') }}" title="Registro de Entrenador"
                                    alt="" width="40" height="40" class="mr-2">CREAR ENTRENADOR</b></h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('entrenadores.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dni">DNI</label>
                                            <input type="text" name="dni" id="dni" class="form-control" value="{{ old('dni') }}">
                                            @foreach ($errors->get('dni') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido_materno"> Apellido Materno</label>
                                            <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"
                                            value="{{old('apellido_materno')}}">
                                            @foreach($errors->get('apellido_materno') as $error)
                                            <span  class="text text-danger">{{$error}}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido_paterno"> Apellido Paterno</label>
                                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"
                                            value="{{old('apellido_paterno')}}">
                                            @foreach($errors->get('apellido_paterno') as $error)
                                            <span  class="text text-danger">{{$error}}</span>
                                            @endforeach
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="direccion" class="form-label">Direccion</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control"
                                            value="{{ old('direccion') }}">
                                                @foreach ($errors->get('direccion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                                 @endforeach
                                            
                                        </div>
                                    </div>


                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firma">Firma</label>
                                            <div class="card border-primary">
                                                <div class="card-body" style="text-align: center;">
                                                    <label for="firma" id="icon-image-firma" class="btn btn-primary" style="display: block;background-color: #2fb98b; "><i class="fas fa-image"></i></label>
                                                    <span id="icon-cerrar-firma"></span>
                                                    <input id="firma" class="d-none" type="file" name="firma" onchange="previsualizacionImage(event)" accept="image/*">
                                                    @foreach ($errors->get('firma') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                    <input type="hidden" id="firma_actual" name="firma_actual" value="{{ old('firma_actual') }}">
                                                    <img id="img-preview-firma" style="max-width: 100%; max-height: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="foto">Foto</label>
                                            <div class="card border-primary">
                                                <div class="card-body" style="text-align: center;">
                                                    <label for="foto" id="icon-image-foto" class="btn btn-primary" style="display: block;background-color: #2fb98b; "><i class="fas fa-image"></i></label>
                                                    <span id="icon-cerrar-foto"></span>
                                                    <input id="foto" class="d-none" type="file" name="foto" onchange="previsualizacionFoto(event)" accept="image/*">
                                                    @foreach ($errors->get('foto') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                    <input type="hidden" id="foto_actual" name="foto_actual" value="{{ old('foto_actual') }}">
                                                    <img id="img-preview-foto" style="max-width: 100%; max-height: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    

         
                                    
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                        <a href="{{ route('entrenadores.index') }}" class="btn btn-secondary"><i class="fas fa-ban"></i> Cancelar</a>
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
    window.onload = function () {
        var firma_actual = document.getElementById('firma_actual').value;
        if (firma_actual) {
            var imgPreview = document.getElementById('img-preview-firma');
            imgPreview.setAttribute('src', firma_actual);
        }

        var foto_actual = document.getElementById('foto_actual').value;
        if (foto_actual) {
            var imgPreviewFoto = document.getElementById('img-preview-foto');
            imgPreviewFoto.setAttribute('src', foto_actual);
        }
    };

    function previsualizacionImage(event) {
        var input = event.target;
        var imgPreview = document.getElementById('img-preview-firma');
        var iconCerrar = document.getElementById('icon-cerrar-firma');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgPreview.setAttribute('src', e.target.result);
                iconCerrar.innerHTML = '<i class="fas fa-times-circle text-danger" onclick="borrarPrevisualizacion()"></i>';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            imgPreview.src = '';
            iconCerrar.innerHTML = '';
        }
    }

    function borrarPrevisualizacion() {
        var imgPreview = document.getElementById('img-preview-firma');
        var iconCerrar = document.getElementById('icon-cerrar-firma');
        var input = document.getElementById('firma');

        imgPreview.src = '';
        iconCerrar.innerHTML = '';
        input.value = '';
    }

    function previsualizacionFoto(event) {
        var input = event.target;
        var imgPreview = document.getElementById('img-preview-foto');
        var iconCerrar = document.getElementById('icon-cerrar-foto');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgPreview.setAttribute('src', e.target.result);
                iconCerrar.innerHTML = '<i class="fas fa-times-circle text-danger" onclick="borrarPrevisualizacionFoto()"></i>';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            imgPreview.src = '';
            iconCerrar.innerHTML = '';
        }
    }

    function borrarPrevisualizacionFoto() {
        var imgPreview = document.getElementById('img-preview-foto');
        var iconCerrar = document.getElementById('icon-cerrar-foto');
        var input = document.getElementById('foto');

        imgPreview.src = '';
        iconCerrar.innerHTML = '';
        input.value = '';
    }
</script>
@stop