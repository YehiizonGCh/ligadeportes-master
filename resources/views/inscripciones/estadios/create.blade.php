@extends('adminlte::page')

@section('title', 'estadios')

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('estadios.index') }}"><i
                                    class="fas fa-expand-arrows-alt mr-2"></i>Estadios</a></li>
                        <li class="breadcrumb-item active">Registro Estadios </li>
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
                        <h3 class="card-text"><b>REGISTRAR ESTADIO</b></h3>
                        <div class="card-body ">
                            <form action="{{ route('estadios.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="direccion">direccion</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control"
                                                value="{{ old('direccion') }}">
                                            @foreach ($errors->get('direccion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="from-group mb-3">
                                            <label for="departamento" class="form-label">departamento</label>
                                            <input type="text" name="departamento" id="departamento" class="form-control"
                                                value="{{ old('departamento') }}">
                                            @foreach ($errors->get('departamento') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>


                                
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label for="clubs_id">Club </label>
                                        <select name="clubs_id" id="clubs_id" class="form-control"
                                            value="{{ old('clubs_id') }}">
                                            @foreach ($clubs as $club)
                                                <option value="{{ $club->id }}">{{ $club->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('clubs_id') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="from-group mb-3">
                                        <label for="imagen" class="form-label">imagen</label>
                                        <input class="form-control" type="file" id="imagen" name="imagen"
                                            accept="image/*">
                                        @foreach ($errors->get('imagen') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach

                                    </div>
                                </div>
                                </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                <a href="{{ route('estadios.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i>
                                    Cancelar</a>
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




@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
