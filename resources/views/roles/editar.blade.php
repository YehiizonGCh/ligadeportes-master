@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}"><i
                                    class="fas fa-user-lock  mr-2"></i>Roles</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-edit mr-2"></i>Actualizar Rol</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')

 

    <section class="section">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card ">


                        <div class="card-header">
                            <h3 class="card-text"><b> EDITAR ROL</b></h3>
                        

                            <div class="card-body">
                                <form class="row "method="POST" action="{{ route('roles.update', $role->id) }}">
                                    @csrf
                                    @method('PUT')

                                        <div class=" col-md-12">
                                            <div class="form-group">
                                                <label for="">Nombre del Rol:</label>
                                                <input type="name" name="name" id="name" class="form-control"
                                                value="{{ $role->name }}">  
                                            @foreach ($errors->get('name') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h4><i class="fas fa-key" style="color:#2fb98b"></i> Permisos para este Rol:</h4>
                                                <div class="row">
                                                @php $counter = 0; @endphp
                                                @foreach ($permission as $value)
                                                <div class="col-md-3">
                                                    <hr>
                                                    <label class="mr-3">
                                                        <input type="checkbox" name="permission[]" value="{{ $value->name }}" {{ $role->hasPermissionTo($value->name) ? 'checked' : '' }}> {{ $value->name }}
                                                    </label>
                                                </div>
                                        
                                                    @php $counter++; @endphp
                                                    @if ($counter % 4 == 0)
                                                    @endif
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Guardar</button>
                                        <a type="button" class="btn btn-secondary ml-2" href="{{ route('roles.index') }}"><i class="fas fa-arrow-left"></i>
                                            Cancelar</a>
                                           

                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')
    @include('footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
