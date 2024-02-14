@extends('adminlte::page')

@section('title', 'Jugadores')
@section('plugins.Sweetalert2', true)
@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-user mr-2"></i>Jugadores</li>
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
                        <h3 class="card-text"><b> PANEL DE JUGADORES</b></h3>
                        <div class="card-body">
                            <h5 class="m-0 float-left">
                                @can('editar-jugador')
                                    <a href="{{ route('jugadores.create') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i> Nuevo</a>
                                @endcan
                               

                                    <a href="{{ route('generar.pdf.jugadores') }}" class="btn btn-danger">
                                        <i class="fas fa-file-pdf"></i> PDF</a>
                            </h5>
                            

                            <form action="{{ route('jugadores.index') }}" method="GET" class=" form-inline justify-content-end">
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
                                            <th>Nombre jugador</th>
                                            <th>DNI</th>  
                                            <th>Foto</th>
                                            <th>Equipo</th>
                                            <th>Posicion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($jugadores) <= 0)
                                            <tr>
                                                <td colspan="7">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach ($jugadores as $jugador)
                                                <tr>
                                                    <td> {{ $jugador->nombres }} {{ $jugador->apellido_paterno }} {{ $jugador->apellido_materno }}</td>
                                                    <td> {{ $jugador->dni }}</td>
                                                    <td>
                                                        <img src="{{ asset('' . $jugador->foto) }}" alt=""
                                                            width="30" height="30" style="border-radius: 50%; border: 2px solid rgb(0, 128, 107);">
                                                    </td>
                                                    
                                                    
                                                    
                                                    <td> {{ $jugador->equipos->nombre }}</td>
                                                    <td> {{ $jugador->posicion }}</td>
                                                        
                                                    <td>
                                                        @if ($jugador->estado)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Suspendido</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @can('editar-jugador')
                                                            <a href="{{ route('jugadores.edit', $jugador->id) }}"
                                                                class="btn btn-warning btn-sm" title="Editar jugador">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('ver-jugador')
                                                            <a href="{{route('jugadores.show', $jugador->id)}}"
                                                                class="btn btn-info btn-sm" title="Ver jugador">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        {{-- cambiar de estado activo a inactivo --}}
                                                        @can('borrar-jugador')
                                                            <form action="{{ route('jugadores.destroy', $jugador->id) }}"
                                                                method="POST" style="display: inline" class="formulario-eliminar">
                                                                @csrf
                                                                @method('DELETE')
                                                                @if ($jugador->estado)
                                                                    <button type="submit" class="btn btn-danger btn-sm "
                                                                        title="Finalizar jugador">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-success btn-sm"
                                                                        title="Activar jugador">
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
                            {{ $jugadores->appends(['texto' => "$texto"]) }}

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

    @if (session('create') == 'El jugador se creó con éxito')
        <script>
             Swal.fire(
              'Registrado!',
              'Se Registró correctamente.',
               'success'
              )
        </script>
    @endif



    @if (session('update') == 'El jugador se actualizó con éxito')
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
                text: "¡Desea cambiar el estado de la jugador!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        '¡Cambiado!',
                        'El estado de la jugador ha sido cambiado.',
                        'success'
                    )
                    this.submit();
                }
            })
        });
    </script>





@stop

