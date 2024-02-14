@extends('adminlte::page')

@section('title', 'ligas')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('ligas.index') }}"><i
                                class="fas fa-poll mr-2"></i>Ligas</a></li>
                    <li class="breadcrumb-item active">Registro de Liga </li>
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
                        <h3 class="card-text"><b>REGISTRAR LIGA</b></h3>

                        <div class="card-body">
                            <form action="{{ route('ligas.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="abreviatura">abreviatura</label>
                                            <input type="text" name="abreviatura" id="abreviatura" class="form-control"
                                                value="{{ old('abreviatura') }}">
                                            @foreach ($errors->get('abreviatura') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="from-group mb-3">
                                            <label for="descripcion" class="form-label">descripcion</label>
                                            <input type="text" name="descripcion" id="descripcion" class="form-control"
                                            value="{{ old('descripcion') }}">
                                                @foreach ($errors->get('descripcion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="from-group mb-3">
                                            <label for="logo" class="form-label">logo</label>
                                            <input class="form-control" type="file" id="logo" name="logo"
                                                accept="image/*" >
                                            @foreach ($errors->get('logo') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                    {{-- </div>
                                    <div class="col-md-6">
                                    <div class="from-group">
                                    <label for="torneos_id">torneo </label>
                                    <select name="torneos_id" id="torneos_id" class="form-control" value="{{ old('torneos_id') }}">
                                        @foreach ($torneos as $torneo)
                                            <option value="{{$torneo->id}}">{{$torneo->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @foreach ($errors->get('torneos_id') as $error)
                                        <span class="text text-danger">{{ $error }}</span>
                                    @endforeach
                                    </div>
                                </div> --}}

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="{{ route('ligas.index') }}" class="btn btn-secondary">Cancelar</a>
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




