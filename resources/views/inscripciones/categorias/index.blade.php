@extends('adminlte::page')
 
@section('title', 'Categorias')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-futbol mr-2"></i>Categorias</li>
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
                        <h3 class="card-text"><b> PANEL DE CATEGORIAS</b></h3>
                        <div class="card-body">
                            <h5 class="m-0 float-left">
                                @can('crear-categoria')
                                    <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i> Nuevo</a> 
                                @endcan
                                    
                                    <a href="{{ route('generar.pdf.categorias') }}" class="btn btn-danger"> <i
                                        class="fas fa-file-pdf"></i> PDF</a>
                            </h5>
                            

                            <form action="{{ route('categorias.index') }}" method="GET" class=" form-inline justify-content-end">
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
                                            <th>Edad</th>
                                            <th>Torneo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($categorias) <= 0)
                                            <tr>
                                                <td colspan="8">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach ($categorias as $categoria)
                                                <tr>
                                                    <td> {{ $categoria->nombre }}</td>
                                                    <td> {{ $categoria->edad_minima }} - {{ $categoria->edad_maxima }} _Años
                                                    </td>
                                                    <td> {{ $categoria->torneos->nombre }}</td>
                                                    <td>
                                                        @if ($categoria->estado)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Finalizado</span>
                                                        @endif
                                                    </td>

                                                    {{-- botones alineados al centro --}}
                                                    <td>
                                                        {{-- modal editar categoria --}}
                                                        @can('editar-categoria')
                                                            <a href="{{ route('categorias.edit', $categoria->id) }}"
                                                                class="btn btn-warning btn-sm" title="Editar categoria">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        @endcan

                                                        @can('ver-categoria')
                                                            <a href="{{route('categorias.show', $categoria->id)}}"
                                                                class="btn btn-info btn-sm" title="Ver categoria">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan

                                                        @can('borrar-categoria')
                                                            {{-- cambiar de estado activo a inactivo --}}
                                                            <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                                                method="POST" style="display: inline"
                                                                class="formulario-eliminar">
                                                                @csrf
                                                                @method('DELETE')
                                                                @if ($categoria->estado)
                                                                    <button type="submit" class="btn btn-danger btn-sm "
                                                                        title="Finalizar categoria">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-success btn-sm"
                                                                        title="Activar categoria">
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
                            {{ $categorias->appends(['texto' => "$texto"]) }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- mostrar modal editar --}}



@section('footer')
    @include('footer')
@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('create') == 'La categoria se creo con exito')
        <script>
            Swal.fire(
                'Registrado!',
                'Se Registró correctamente.',
                'success'
            )
        </script>
    @endif



    @if (session('update') == 'La categoria se actualizo con exito')
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
                text: "¡Desea cambiar el estado de la categoria!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        '¡Cambiado!',
                        'El estado de la categoria ha sido cambiado.',
                        'success'
                    )
                    this.submit();
                }
            })
        });
    </script>

@stop
