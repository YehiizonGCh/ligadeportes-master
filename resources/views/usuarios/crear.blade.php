@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}"><i
                                    class="fas fa-users fa-fw mr-2"></i>Usuarios</a></li>
                        <li class="breadcrumb-item active">Registro de Usuarios</li>
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
                            <h3 class="card-text"><b> REGISTRAR USUARIO</b></h3>
                        
                            <div class="card-body">

                            
                                <form method="POST" action="{{ route('usuarios.store') }}" >
                                    @csrf
                                    <div class="row">
                                        <div class=" col-md-12">
                                            <div class="form-group">
                                                <label for="name">Nombre</label>
                                                <input type="name" name="name" id="name" class="form-control"
                                                value="{{ old('name') }}" >
                                                @foreach ($errors->get('name') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach 
                                            </div>
                                        </div>
                                        <div class=" col-md-12">
                                            <div class="form-group">
                                                <label for="email">E-mail</label>                                            
                                                <input type="email" name="email" id="email" class="form-control"
                                                value="{{old('email')}}">
                                                @foreach ($errors->get('email') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                                @endforeach                                        
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
                                                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                                        <i class="fa fa-eye" id="eyeIcon"></i>
                                                    </button>
                                                </div>
                                                @foreach ($errors->get('password') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class=" col-md-12">
                                            <div class="form-group">
                                                <label for="confirm-password">Confirmar Password</label>
                                                <input type="password" name="confirm-password" id="confirm-password" class="form-control"
                                                value="{{old('confirm-password')}}">
                                                @foreach ($errors->get('confirm-password') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                                @endforeach                                         
                                            </div>
                                        </div>
                                        <div class=" col-md-12">
                                            <div class="form-group">
                                                <label for="roles">Roles</label>
                                                <select name="roles[]" class="form-control">
                                                    <option value="" disabled selected>Seleccione un rol</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role }}">{{ $role }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('roles') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                                    Guardar</button>
                                                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"><i
                                                        class="fas fa-ban"></i> Cancelar</a>
                                            </div>
        
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            var passwordInput = document.getElementById('password');
            var eyeIcon = document.getElementById('eyeIcon');
    
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fa fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fa fa-eye';
            }
        });
    </script>
@stop





