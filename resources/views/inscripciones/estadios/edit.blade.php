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
                        <li class="breadcrumb-item active"><i class="fas fa-edit mr-2"></i>Editar Estadio</li>
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
                        <h3 class="card-text"><b>EDITAR ESTADIO</b></h3>

                        <div class="card-body">
                            <form class="row"method="POST" action="{{ route('estadios.update', $estadio->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ $estadio->nombre }}">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="direccion">direccion</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control"
                                                value="{{ $estadio->direccion }}">
                                            @foreach ($errors->get('direccion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="departamento">departamento</label>
                                            <input type="text" name="departamento" id="departamento" class="form-control"
                                                value="{{ $estadio->departamento }}">
                                            @foreach ($errors->get('departamento') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>
{{-- club --}}
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="clubs_id">club</label>
                                            <select name="clubs_id" id="clubs_id" class="form-control">
                                                @foreach ($clubs as $club)
                                                    <option value="{{ $club->id }}"
                                                        {{ $estadio->clubs_id == $club->id ? 'selected' : '' }}>
                                                        {{ $club->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="from-group mb-3">
                                            <label for="imagen" class="form-label">imagen</label>
                                            {{-- mostrar imagen --}}
                                            <img src="{{ asset('' . $estadio->imagen) }}" alt="" width="100">
                                            <input type="file" class="form-control" id="imagen" name="imagen"
                                                {{-- value="{{ $estadio->imagen }}" --}}
                                                accept="image/*" value="{{ $estadio->imagen }}">
                                            @foreach ($errors->get('imagen') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>


                                    
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i>
                                            Guardar</button>

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
