@extends('adminlte::page')

@section('title', 'Clubs')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-shield-alt mr-2"></i>Clubs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text"><b> PANEL DE CLUBS</b></h3>
                        <div class="card-body">
                            <h5 class="m-0 float-left">
                                @can('crear-club')
                                    <a href="{{ route('clubs.create') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i> Nuevo</a>
                                @endcan
                                <a href="{{ route('generar.pdf.clubes') }}" class="btn btn-danger">
                                    <i class="fas fa-file-pdf"></i> PDF</a>
                            </h5>                           
                            <form action="{{ route('clubs.index') }}" method="GET" class=" form-inline justify-content-end">
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
                            <div class="mt-2 table-responsive text-center ">
                                <table class="table  table-hover table-borderless shadow p-2 mb-5 bg-body rounded"
                                    style="border-radius: 10px; overflow: hidden;">
                                    <thead class="text-white" style="background-color:#2fb98b">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Logo</th>
                                            <th>Temporada</th>
                                            <th>Domicilio</th>
                                            <th>Representante</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($clubs) <= 0)
                                            <tr>
                                                <td colspan="7">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach ($clubs as $club)
                                                <tr>
                                                    <td>{{ $club->nombre }}</td>
                                                    <td><img src="{{ asset('' . $club->logo) }}" alt=""
                                                            width="30" height="30"></td>
                                                    <td>{{ $club->temporada }}</td>
                                                    <td>{{ $club->domicilio }}</td>
                                                    <td>{{ $club->representante }}</td>
                                                    <td>
                                                        @if ($club->estado)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactivo</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @can('editar-club')
                                                            <a href="{{ route('clubs.edit', $club->id) }}" title="Editar Club"
                                                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                        @endcan

                                                        @can('ver-club')
                                                            <a href="{{ route('clubs.show', $club->id) }}"
                                                                class="btn btn-primary btn-sm" title="Ver club"><i
                                                                    class="fas fa-eye"></i></a>
                                                        @endcan
                                                        {{-- cambiar de estado activo a inactivo --}}
                                                        @can('borrar-club')
                                                            <form action="{{ route('clubs.destroy', $club->id) }}"
                                                                method="POST" style="display: inline"
                                                                class="formulario-eliminar">
                                                                @csrf
                                                                @method('DELETE')
                                                                @if ($club->estado)
                                                                    <button type="submit" class="btn btn-danger btn-sm "
                                                                        title="Finalizar club">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-success btn-sm"
                                                                        title="Activar club">
                                                                        <i class="fas fa-check"></i>
                                                                    </button>
                                                                @endif
                                                            </form>
                                                        @endcan


                                                    </td>
                                                    {{-- @include('inscripciones.clubs.modal.edit') --}}

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>



                            </div>
                            {{ $clubs->appends(['texto' => "$texto"]) }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop




    @section('js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session('create') == 'El club se creo con exito')
            <script>
                Swal.fire(
                    'Registrado!',
                    'Se Registró correctamente.',
                    'success'
                )
            </script>
        @endif



        @if (session('update') == 'El club se actualizo con exito')
            {{-- validar que se hallan echo cambios  sino que muestre no se isieron cambios --}}
            <script>
                Swal.fire(
                    'Actualizado!',
                    'Se Actualizó correctamente.',
                    'success'
                )
            </script>
        @endif
        <script>
            $('.formulario-eliminar').submit(function(e) {
                e.preventDefault();
                // validar si el estado esta activo o finzalizado para mostrar el mensaje con sweetalert
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "¡Desea cambiar el estado de la club!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Si, cambiar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            '¡Cambiado!',
                            'El estado de la club ha sido cambiado.',
                            'success'
                        )
                        this.submit();
                    }
                })
            });
        </script>








    @stop
