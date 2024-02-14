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
                    <li class="breadcrumb-item active"><i class="fas fa-edit mr-2"></i>Editar Categoria</li>
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
                                    src="{{ asset('https://cdn-icons-png.flaticon.com/512/3405/3405818.png') }}"
                                    title="Editar Categoria" alt="" width="40" height="40" class="mr-2">EDITAR
                                CATEGORIA</b></h3>
                        <div class="card-body ">
                            <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="row mt-3">


                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ $categoria->nombre }}">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="abreviatura"> Abreviatura</label>
                                            <input type="text" name="abreviatura" id="abreviatura" class="form-control"
                                                value="{{ $categoria->abreviatura }}">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="edad_minima"> Edad Minima</label>
                                            <input name="edad_minima" id="edad_minima" class="form-control" type="number"
                                                min="5" max="25" step="1"
                                                value="{{ $categoria->edad_minima }}">
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
                                                value="{{ $categoria->edad_maxima }}">
                                            @foreach ($errors->get('edad_maxima') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sexo">Sexo</label>
                                            {{-- selecciona sexo MASCULINO Y FEMENINO --}}
                                            <select name="sexo" id="sexo" class="form-control">
                                                <option value="MASCULINO"
                                                    {{ $categoria->sexo == 'MASCULINO' ? 'selected' : '' }}>MASCULINO
                                                </option>
                                                <option value="FEMENINO"
                                                    {{ $categoria->sexo == 'FEMENINO' ? 'selected' : '' }}>
                                                    FEMENINO</option>
                                            </select>

                                            {{-- <input type="text" name="sexo" id="sexo" class="form-control"> --}}
                                            @foreach ($errors->get('sexo') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach


                                        </div>
                                    </div>

                                    {{-- torneo --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="torneos_id">Torneo</label>
                                            <select name="torneos_id" id="torneos_id" class="form-control">
                                                @foreach ($torneos as $torneo)
                                                    <option value="{{ $torneo->id }}"
                                                        {{ $categoria->torneos_id == $torneo->id ? 'selected' : '' }}>
                                                        {{ $torneo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i>
                                            Actualizar</button>
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
