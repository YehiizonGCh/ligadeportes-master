@extends('adminlte::page')

@section('title', 'Configuración')

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-fw fa-user mr-2"></i>Actualizar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')

    <!-- incluir mensajes de acciones -->
    @include('mensaje.confirmación')

    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <form action="{{ route('changePassword') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card card-info">
                        <div class="card-header">
                            <h4 class="card-title">Actualizar Contraseña</h4>
                        </div>

                        <div class="card-body">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mt-2">
                                    <label for="name">Nombre de Usuario</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mt-2">
                                    <label for="password_actual">Clave Actual</label>
                                    <input type="password" name="password_actual"
                                        class="form-control @error('password_actual') is-invalid @enderror" required>
                                    @error('password_actual')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mt-2">
                                    <label for="new_password ">Nueva Clave</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mt-2">
                                    <label for="confirm_password">Confirmar nueva Clave</label>
                                    <input type="password" name="confirm_password"
                                        class="form-control @error('confirm_password') is-invalid @enderror"required>
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary" id="formSubmit">Guardar
                                        Cambios</button>
                                    <a class="btn btn-danger" href="{{ route('dash') }}">Salir</a>
                                </div>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>
    </div>
@stop

@section('footer')
    @include('footer')
@stop
