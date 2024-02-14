@extends('adminlte::page')

@section('title', 'Arbitros')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('arbitros.index') }}"><i
                                    class="fas fa-user mr-2"></i>Arbitros</a></li>
                        <li class="breadcrumb-item active">Registro de Arbitros</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text"><b> CREAR ARBITRO</b></h3>
                        <div class="card-body ">
                        
                            <form action="{{ route('arbitros.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="from-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ old('nombre') }}">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="from-group">
                                            <label for="apellido_paterno">Apellido Paterno</label>
                                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"
                                                value="{{ old('apellido_paterno') }}">
                                            @foreach ($errors->get('apellido_paterno') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="from-group">
                                            <label for="apellido_materno">Apellido Materno</label>
                                            <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"
                                                value="{{ old('apellido_materno') }}">
                                            @foreach ($errors->get('apellido_materno') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    
                                    
                                    <div class="col-md-3">
                                        <div class="from-group">
                                            <label for="dni">Dni</label>
                                            <input type="number" name="dni" id="dni" class="form-control"
                                                value="{{ old('dni') }}">
                                            @foreach ($errors->get('dni') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="from-group">
                                            <label for="telefono">Telefono</label>
                                            <input type="number" name="telefono" id="telefono" class="form-control"
                                                value="{{ old('telefono') }}">
                                            @foreach ($errors->get('telefono') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="from-group">
                                            <label for="edad">Edad</label>
                                            <input type="number" name="edad" id="edad" class="form-control"
                                                value="{{ old('edad') }}" min="18" max="100" >
                                            @foreach ($errors->get('edad') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="from-group">
                                            <label for="tipo_arbitro">Tipo de Arbitro</label>
                                            <input type="text" name="tipo_arbitro" id="tipo_arbitro" class="form-control"
                                                value="{{ old('tipo_arbitro') }}">
                                            @foreach ($errors->get('tipo_arbitro') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>


                                    

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i>
                                                Guardar</button>
                                            <a href="{{ route('arbitros.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i>
                                                Cancelar</a>
                                        </div>

                                    </div>
                                    <div id="mensaje-edad" class="alert alert-danger" style="display: none;">
                                            Debes ser mayor de 18 años para continuar.
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
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    

  
@stop
