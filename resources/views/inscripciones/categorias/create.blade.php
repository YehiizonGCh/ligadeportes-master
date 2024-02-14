@extends('adminlte::page')

@section('title', 'Categorias')
@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}"><i
                                    class="fas fa-futbol mr-2"></i>Categorias</a></li>
                        <li class="breadcrumb-item active">Registro de Categoria</li>
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
                        <h3 class="card-text"><b><img src="{{ asset('https://cdn-icons-png.flaticon.com/512/3405/3405818.png') }}" title="Registro de Categoria"
                                    alt="" width="40" height="40" class="mr-2">CREAR CATEGORIA</b></h3>
                        <div class="card-body ">
                            <form method="POST" action="{{ route('categorias.store') }}">
                                @csrf
                                <div class="row mt-3">
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
                                            <label for="abreviatura"> Abreviatura</label>
                                            <input type="text" name="abreviatura" id="abreviatura" class="form-control"
                                                value="{{ old('abreviatura') }}">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="edad_minima"> Edad Minima</label>
                                            <input name="edad_minima" id="edad_minima" class="form-control" type="number"
                                                min="5" max="25" step="1"
                                                value="{{ old('edad_minima') }}">
                                            @foreach ($errors->get('edad_minima') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="edad_maxima"> Edad Maxima</label>
                                            <input name="edad_maxima" id="edad_maxima" class="form-control" type="number"
                                                min="5" max="25" step="1"
                                                value="{{ old('edad_maxima') }}">
                                            @foreach ($errors->get('edad_maxima') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sexo">Sexo</label>
                                            <select name="sexo" id="sexo" class="form-control">
                                                <option value="MASCULINO">MASCULINO</option>
                                                <option value="FEMENINO">FEMENINO</option>
                                            </select>
                                            @foreach ($errors->get('sexo') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="torneos_id">Torneo</label>
                                            <select name="torneos_id" id="torneos_id" class="form-control"
                                                value="{{ old('torneos_id') }}">
                                                <option value="">Seleccione un torneo</option>
                                                @foreach ($torneos as $torneo)
                                                    <option value="{{ $torneo->id }}">{{ $torneo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                            Guardar</button>
                                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary"><i
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
