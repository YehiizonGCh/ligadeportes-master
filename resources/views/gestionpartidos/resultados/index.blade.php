@extends('adminlte::page')

@section('title', 'Resultados de partidos')
@section('plugins.Sweetalert2', true)
@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-poll mr-2"></i>Partidos</li>
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
                        <h3 class="card-text"><b> PANEL DE RESULTADOS DE PARTIDOS</b></h3>
                        <div class="card-body">
                            <h5 class="m-0 float-left">
                                @can('crear-estadistica-partido')
                                    <a href="{{ route('resultados.create') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i> Nuevo</a> 
                                @endcan
                               
                                    <a href="{{ route('generar.pdf.partidosresultados') }}" class="btn btn-danger"> <i
                                        class="fas fa-file-pdf"></i> PDF</a>
                            </h5>
                            
                            <form action="{{ route('resultados.index') }}" method="GET" class=" form-inline justify-content-end">
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
                                <table class="table  table-hover table-borderless shadow p-2 mb-5 bg-body rounded "
                                    style="border-radius: 10px; overflow: hidden;">
                                    <thead class="text-white" style="background-color:#2fb98b">
                                        <tr>                                             
                                            <th>Equipo Local</th>
                                            <th>Logo</th>
                                            <th>Resultado </th>
                                            <th>Logo</th>                                             
                                            <th>Equipo Visitante</th> 
                                            <th>Fecha y Hora</th>
                                            <th >Categoria</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($estadisticapartidos) <= 0)
                                            <tr>
                                                <td colspan="8">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach ($estadisticapartidos as $estadisticapartido)
                                                <tr>
                                                    {{-- <td> {{ $partido->equipo_local }} vs {{ $partido->equipo_visita }}</td> --}}
                                                    <td> {{ $estadisticapartido->partido->equipolocal->club->nombre }}</td>
                                                    
                                                    <td><img src="{{ asset($estadisticapartido->partido->equipolocal->club->logo) }}"  width="40" height="40"
                                                        style="border-radius: 50%; border: 2px solid rgb(177, 190, 188);" class="mr-2"></td>
                                                    <td> {{ $estadisticapartido->goles_local }} - {{ $estadisticapartido->goles_visitante }}</td>
                                                    <td><img src="{{ asset($estadisticapartido->partido->equipovisitante->club->logo) }}"  width="40" height="40"
                                                        style="border-radius: 50%; border: 2px solid rgb(177, 190, 188);" class="mr-2"></td> 
                                                                                                     
                                                    <td> {{ $estadisticapartido->partido->equipovisitante->club->nombre }}</td>
                                                    <td class="text-center"> {{ $estadisticapartido->partido->fecha_partido }} <br>
                                                        Hora: {{ $estadisticapartido->partido->hora_partido }}</td>  
                                                    <td> {{ $estadisticapartido->partido->categoria->nombre }}</td>
                                                    <td>
                                                        @if ($estadisticapartido->partido->estado)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Finalizado</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @can('editar-estadistica-partido')
                                                            <a href="{{ route('resultados.edit', $estadisticapartido->id) }}"
                                                                class="btn btn-warning btn-sm" title="Editar partido">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        @endcan

                                                        @can('ver-estadistica-partido')
                                                            {{-- ver partido --}}
                                                            <a href="{{route('resultados.show',$estadisticapartido->id)}}"
                                                                class="btn btn-info btn-sm" title="Ver partido">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        
                                                        @can('borrar-estadistica-partido')
                                                         {{-- cambiar de estado activo a inactivo --}}
                                                            <form action="{{ route('resultados.destroy', $estadisticapartido->id) }}"
                                                                method="POST" style="display: inline" class="formulario-eliminar">
                                                                @csrf
                                                                @method('DELETE')
                                                                @if ($estadisticapartido->estado)
                                                                    <button type="submit" class="btn btn-danger btn-sm "
                                                                        title="Finalizar partido">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-success btn-sm"
                                                                        title="Activar partido">
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
                            {{ $estadisticapartidos->appends(['texto' => "$texto"]) }}

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

    @if (session('create') == 'Resultado registrado con exito')
        <script>
            Swal.fire(
                'Registrado!',
                'Se Registró correctamente.',
                'success'
            )
        </script>
    @endif



    @if (session('update') == 'Resultado actualizado con exito')
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
                text: "¡Desea cambiar el estado del resultado!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        '¡Cambiado!',
                        'El estado del resultado ha sido cambiado.',
                        'success'
                    )
                    this.submit();
                }
            })
        });
    </script>





@stop

