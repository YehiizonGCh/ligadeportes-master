@extends('adminlte::page')

@section('title', 'Clubs')

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('clubs.index') }}"><i
                                    class="fas fa-shield-alt mr-2"></i>Clubs</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-edit mr-2"></i>Actualizar Club</li>
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
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/128/10068/10068311.png') }}"
                                    title="Club" alt="" width="40" height="40" class="mr-2">EDITAR
                                CLUB</b></h3>
                        <div class="card-body ">

                            <form class="row g-3"method="POST" action="{{ route('clubs.update', $club->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row ">
                                    <div class="col-md-6">

                                        <div class="from-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ $club->nombre }}">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="abreviatura"> Abreviatura</label>
                                            <input type="text" name="abreviatura" id="abreviatura" class="form-control"
                                                value="{{ $club->abreviatura }}">
                                            @foreach ($errors->get('abreviatura') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="descripcion"> Descripcion</label>
                                            <textarea type="text" name="descripcion" id="descripcion" class="form-control" rows="7"
                                                >{{ $club->descripcion }}</textarea>
                                            @foreach ($errors->get('descripcion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <div class="card ">
                                                <div class="card-body" style="text-align: center;">
                                                    <label for="logo" id="icon-image" class="btn btn-primary"
                                                        style="display: block; background-color: #2fb98b;"><i
                                                            class="fas fa-image"></i></label>
                                                    <span id="icon-cerrar"></span>
                                                    <input id="logo" class="d-none" type="file" name="logo"
                                                        onchange="previsualizacionImage(event)" accept="image/*">
                                                    @error('logo')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <input type="hidden" id="foto_actual" name="foto_actual"
                                                        value="{{ $club->logo }}">
                                                    <img id="img-preview" style="max-width: 100%; max-height: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="temporada"> Temporada</label>
                                            <input type="text" name="temporada" id="temporada" class="form-control"
                                                value="{{ $club->temporada }}">
                                            @foreach ($errors->get('temporada') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="domicilio">Domicilio</label>
                                            <input type="text" name="domicilio" id="domicilio" class="form-control"
                                                value="{{ $club->domicilio }}">
                                            @foreach ($errors->get('domicilio') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12 card-header border-primary mb-2">
                                            <h3 class="card-title">
                                                <i class="fas fa-user" style="margin-right: 10px; color: #2fb98b;"></i>
                                                DATOS DEL REPRESENTANTE
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="representante">NOMBRES DEL REPRESENTANTE</label>
                                            <input type="text" name="representante" id="representante"
                                                class="form-control" value="{{ $club->representante }}">
                                            @foreach ($errors->get('representante') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="dni_representante">DNI</label>
                                            <div class=" d-flex flex-row">
                                                <input type="text" name="dni_representante" id="dni_representante"
                                                    class="form-control" value="{{ $club->dni_representante }}">
                                                @foreach ($errors->get('dni_representante') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                                {{-- <button type="submit" class="btn btn-primary  ">BUSCAR</button> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card mt-3">
                                            <div class="card-header border-primary mb-2">
                                                <h5 class="card-title"><b><i class="fas fa-futbol"
                                                            style="margin-right: 10px; color: #2fb98b;"></i> CATEGORIAS EN
                                                        LAS QUE PARTICIPARÁ</b></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @if ($categorias)
                                                        @foreach ($categorias as $id => $nombre)
                                                            <div class="col-md-4">
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="categorias[]"
                                                                        id="categorias" value="{{ $id }}"
                                                                        {{ $club->categorys()->pluck('categorys_id')->contains($id)? 'checked': '' }}>
                                                                    <label for="categorias">{{ $nombre }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <br>
                                                        @error('categorias')
                                                            <small class="text-danger" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    @else
                                                        <div class="alert alert-secondary">No se encontraron resultados.
                                                        </div>
                                                        @error('categorias')
                                                            <small class="text-danger" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-warning"><i
                                                    class="fas fa-edit"></i>EDITAR</button>
                                            <a href="{{ route('clubs.index') }}" class="btn btn-secondary"><i
                                                    class="fas fa-ban"></i>CANCELAR</a>
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
            input.value = '';
        }
    </script>
@stop


