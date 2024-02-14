@extends('adminlte::page')

@section('title', 'ligas')
@section('plugins.Sweetalert2', true)

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-poll mr-2"></i>Ligas</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text"><b> PANEL DE LIGAS</b></h3>
                        <div class="card-body">
                            <h5 class="m-0 float-left">
                                @can('crear-liga')
                                    <a href="{{ route('ligas.create') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i> CREAR</a>
                                @endcan
                                    <a href="" class="btn btn-danger">
                                    <i class="fas fa-file-pdf"></i> PDF</a>
                            </h5>
                            <form action="{{ route('ligas.index') }}" method="GET" class=" form-inline justify-content-end">
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
                                            <th>ABREVIATURA</th>
                                            <th>DESCRIPCION</th>
                                            <th>LOGO</th>
                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($ligas) <= 0)
                                            <tr>
                                                <td colspan="6">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach ($ligas as $liga)
                                                <tr>
                                                    <td> {{ $liga->nombre }}</td>
                                                    <td> {{ $liga->abreviatura }}</td>
                                                    <td> {{ $liga->descripcion }}</td>
                                                    <td><img src="{{ asset('' . $liga->logo) }}" alt="" width="50">
                                                    </td>

                                                    <td>
                                                        @if ($liga->estado)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Finalizado</span>
                                                        @endif
                                                    </td>

                                                    {{-- botones alineados al centro --}}
                                                    <td>
                                                        
                                                        @can('editar-liga')
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                data-toggle="modal" title="Editar Liga"
                                                                style="display: inline"
                                                                data-target="#editar{{ $liga->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            @include('eventos.ligas.modal.edit')
                                                        @endcan
                                                        
                                                        @can('ver-liga')
                                                            <button type="button" class="btn btn-info btn-sm"
                                                                data-toggle="modal" title="Ver liga"
                                                                data-target="#mostrar{{ $liga->id }}" >
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            @include('eventos.ligas.modal.show')

                                                        @endcan

                                                        @can('borrar-liga')
                                                            {{-- cambiar de estado activo a inactivo --}}
                                                            <form action="{{ route('ligas.destroy', $liga->id) }}"
                                                                method="POST" style="display: inline" class="formulario-eliminar">
                                                                @csrf
                                                                @method('DELETE')
                                                                @if ($liga->estado)
                                                                    <button type="submit" class="btn btn-danger btn-sm "
                                                                        title="Finalizar liga">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-success btn-sm"
                                                                        title="Activar liga">
                                                                        <i class="fas fa-check"></i>
                                                                    </button>
                                                                @endif
                                                            </form>
                                                        @endcan
                                                    </td>

                                                    



                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            {{ $ligas->appends(['texto' => "$texto"]) }}

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
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('create') == 'La liga se creo con exito')
        <script>
            Swal.fire(
                'Registrado!',
                'Se Registró correctamente.',
                'success'
            )
        </script>
    @endif



    @if (session('update') == 'La liga se actualizo con exito')
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

        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
            // validar si el estado esta activo o finzalizado para mostrar el mensaje con sweetalert
            Swal.fire({
                title: '¿Está seguro?',
                text: "¡Desea cambiar el estado de la liga!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        '¡Cambiado!',
                        'El estado de la liga ha sido cambiado.',
                        'success'
                    )
                    this.submit();
                }
            })
        });
    </script>





@stop

