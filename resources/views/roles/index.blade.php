@extends('adminlte::page')

@section('title', 'Roles')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-user-lock mr-2"></i>Roles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <!-- incluir mensajes de acciones -->

    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card " >
                    <div class="card-header " >
                        <h3 class="card-text"><b> PANEL DE ROLES</b></h3>
                    

                        <div class="card-body">

                            @can('crear-rol')
                                <a class="btn btn-primary mb-1" href="{{ route('roles.create') }}"><i class="fas fa-file"></i>
                                    Nuevo</a>
                            @endcan


                            <form action="{{ route('roles.index') }}" method="GET" class=" form-inline justify-content-end">
                                @csrf
                                <div class="input-group  ">
                                    <input type="text" class="form-control  " name="texto" placeholder="Buscar..."
                                        value="{{ $texto }}">


                                    <div class="input-group-append">
                                        <button type="submit" class="btn  btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </form>
                            <div class="  mt-2 table-responsive  ">
                                <table class="table  table-hover  shadow p-2 mb-5 bg-body rounded"
                                    style="border-radius: 10px; overflow: hidden;">
                                    <thead class="text-white" style="background-color:#2fb98b">
                                        <tr class="active">
                                            <th width="15px">#</th>
                                            <th>Rol</th>
                                            <th width="30px" >Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td class="btn-group">
                                                    @can('editar-rol')
                                                        <a class="btn btn-warning btn-sm" href="{{ route('roles.edit', $role->id) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endcan

                                                    @can('borrar-rol')
                                                        <!-- boton para eliminar -->
                                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'class' => 'formulario-eliminar','style'=>'display:inline']) !!}
                                                        {{Form::button('<i class="far fa-trash-alt icon-size"></i>', ['type' =>'submit', 'class' => 'btn btn-sm btn-danger'])}}
                                                        {!! Form::close() !!}
                                                        <!-- fin boton eliminar -->
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            {{ $roles->appends(['texto' => "$texto"]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @include('footer')
@stop

<!-- links para estilos css -->
@section('css')
    @include('roles.partials.css')
@stop

<!-- links de scripts -->
@section('js')
    @include('roles.partials.scripts')
@stop
