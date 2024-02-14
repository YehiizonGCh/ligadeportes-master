@extends('adminlte::page')

@section('title', 'Usuarios')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-users fa-fw mr-2"></i>Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')


    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card">

                    <div class="card-header">
                        <h3 class="card-text"><b> PANEL DE USUARIOS</b></h3>

                        <div class="card-body">

                            @can('crear-usuario')
                            <a class="btn btn-primary mb-1" href="{{ route('usuarios.create') }}"><i class="fas fa-file"></i>
                                Nuevo</a>
                            @endcan

                            <form action="{{ route('usuarios.index') }}" method="GET" class=" form-inline justify-content-end">
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
                                            <th>Nombre</th>
                                            <th>E-mail</th>
                                            <th>Estado</th>
                                            <th>Rol</th>
                                            <th width="15px">Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td>{{ $usuario->id }}</td>
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                @if ($usuario->estado)
                                                        <span class="badge badge-success">
                                                            <form method="post" action="{{url('/camestadousu/'.$usuario->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success">Activo <i class="fas fa-check-circle"></i>
                                                            </button>
                                                            </form>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            <form method="post" action="{{url('/camestadousu/'.$usuario->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger">Inactivo <i class="fas fa-ban"></i>
                                                            </button>
                                                            </form>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($usuario->getRoleNames()))
                                                        @foreach ($usuario->getRoleNames() as $rolNombre)
                                                            <h5>
                                                                <span class="badge badge-dark">{{ $rolNombre }}</span>
                                                            </h5>
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td  class="btn-group">                                                 
                                                    @can('editar-usuario')
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ route('usuarios.edit', $usuario->id) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endcan
                                                
                                                    {!! Form::open(['method' => 'DELETE','route' => ['usuarios.destroy', $usuario->id],'class' => 'formulario-eliminar','style'=>'display:inline']) !!}
                                                    {{Form::button('<i class="far fa-trash-alt icon-size"></i>', ['type' =>'submit', 'class' => 'btn btn-sm btn-danger'])}}
                                                    {!! Form::close() !!}
                                                
                                                    <!-- fin boton eliminar -->
                                                </td>
                                               
                                                <!--Ventana Modal para la Alerta de Eliminar--->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $usuarios->appends(['texto' => "$texto"])->links() }}
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
