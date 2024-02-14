@extends('adminlte::page')

@section('title', 'torneos')
@section('plugins.Sweetalert2', true)
@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-shapes mr-2"></i>Torneos</li>
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
                        <h3 class="card-text"><b> PANEL DE TORNEOS</b></h3>
                        <div class="card-body">
                            <h5 class="m-0 float-left">
                                @can('crear-torneo')
                                    <a href="{{ route('torneos.create') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i> Nuevo</a>
                                @endcan
                                    
                                    <a href="" class="btn btn-danger">
                                    <i class="fas fa-file-pdf"></i> PDF</a>
                            </h5>
                            <form action="{{ route('torneos.index') }}" method="GET" class=" form-inline justify-content-end">
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
                                            <th>Fecha Inicio</th>                                            
                                            <th>Fecha Fin</th>
                                            <th>Liga Deportiva</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($torneos) <= 0)
                                            <tr>
                                                <td colspan="6">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach ($torneos as $torneo)
                                                <tr>
                                                    <td> {{ $torneo->nombre }}</td>
                                                    <td><img src="{{ asset('' . $torneo->logo) }}" alt="" width="30" height="30">
                                                    </td>
                                                    <td> {{ $torneo->fecha_inicio }}</td>                                        
                                                    <td> {{ $torneo->fecha_fin }}</td>
                                                    <td> {{ $torneo->liga->nombre }}</td>
                                                        
                                                    <td>
                                                        @if ($torneo->estado)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Finalizado</span>
                                                        @endif
                                                    </td>

                                                    {{-- botones alineados al centro --}}
                                                    <td>
                                                        @can('editar-torneo')
                                                            <a href="{{ route('torneos.edit', $torneo->id) }}"
                                                                class="btn btn-warning btn-sm" title="Editar torneo">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endcan

                                                        @can('ver-torneo')
                                                            <button type="button" class="btn btn-info btn-sm"
                                                                data-toggle="modal" title="Ver torneo"
                                                                data-target="#mostrar{{ $torneo->id }}" >
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            @include('eventos.torneos.modal.show')
                                                        @endcan
                                                        {{-- fin modal ver torneo --}}

                                                        @can('borrar-torneo')
                                                            {{-- cambiar de estado activo a inactivo --}}
                                                            <form action="{{ route('torneos.destroy', $torneo->id) }}"
                                                                method="POST" style="display: inline" class="formulario-eliminar">
                                                                @csrf
                                                                @method('DELETE')
                                                                @if ($torneo->estado)
                                                                    <button type="submit" class="btn btn-danger btn-sm "
                                                                        title="Finalizar torneo">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-success btn-sm"
                                                                        title="Activar torneo">
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
                            {{ $torneos->appends(['texto' => "$texto"]) }}

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

    @if (session('create') == 'El torneo se creo con exito')
        <script>
            Swal.fire(
                'Registrado!',
                'Se Registró correctamente.',
                'success'
            )
        </script>
    @endif



    @if (session('update') == 'El torneo se actualizo con exito')
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
                text: "¡Desea cambiar el estado de la torneo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        '¡Cambiado!',
                        'El estado de la torneo ha sido cambiado.',
                        'success'
                    )
                    this.submit();
                }
            })
        });
    </script>








@stop

