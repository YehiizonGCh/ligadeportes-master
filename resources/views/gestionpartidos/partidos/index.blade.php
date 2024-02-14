@extends('adminlte::page')

@section('title', 'Partidos')
@section('plugins.Sweetalert2', true)

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-users mr-2"></i>Partidos</li>
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
                        <h3 class="card-text"><b> PANEL DE PARTIDOS</b></h3>
                        <div class="card-body">
                            <h5 class="m-0 float-left">
                                @can('crear-partido')
                                    <a href="{{ route('partidos.create') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i> Nuevo</a>
                                @endcan

                                    <a href="{{ route('generar.pdf.partidos') }}" class="btn btn-danger"> <i
                                        class="fas fa-file-pdf"></i> PDF</a>
                            </h5>
                            <br><br>

                            <form action="{{ route('partidos.index') }}" method="GET">
                                @csrf
                                <div class="input-group float-right">
                                    <input type="text" class="form-control " name="texto" placeholder="Buscar..."
                                        value="{{ $texto }}">

                                        <input type="date" class="form-control" name="fecha_inicial" id="fecha_inicial" value="{{ $fecha_inicial }}">
                                        <input type="date" class="form-control" name="fecha_final" id="fecha_final" value="{{ $fecha_final }}">


                                    <div class="input-group-append">
                                        <button type="submit" class="btn  btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <br><br>

                            <div class="mt-2 table-responsive text-center ">
                                <table class="table  table-hover table-borderless shadow p-2 mb-5 bg-body rounded"
                                    style="border-radius: 10px; overflow: hidden;">
                                    <thead class="text-white" style="background-color:#2fb98b">
                                        <tr>                                             
                                            <th>Equipo Local</th>
                                            <th>Logo</th>
                                            <th> </th>
                                            <th>Logo</th>                                             
                                            <th>Equipo Visitante</th>                                          
                                            <th>Fecha y Hora de encuentro</th>
                                            <th>Categoria</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($partidos) <= 0)
                                            <tr>
                                                <td colspan="9">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach ($partidos as $partido)
                                                <tr>
                                                    {{-- <td> {{ $partido->equipo_local }} vs {{ $partido->equipo_visita }}</td> --}}
                                                    <td> {{ $partido->equipolocal->club->nombre }}</td>
                                                    
                                                    <td><img src="{{ asset($partido->equipolocal->club->logo) }}"  width="30" height="30"
                                                        style="border-radius: 50%; border: 2px solid rgb(177, 190, 188);" class="mr-2"></td>
                                                    <td> @if ($partido->estado == 1)                                                        
                                                         VS                                                      
                                                    @else                                                        
                                                        {{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->goles_local : 0 }} - {{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->goles_visitante : 0 }}
                                                        
                                                    @endif
                                                    </td>
                                                    <td><img src="{{ asset($partido->equipovisitante->club->logo) }}"  width="30" height="30"
                                                        style="border-radius: 50%; border: 2px solid rgb(177, 190, 188);" class="mr-2"></td> 
                                                                                                     
                                                    <td> {{ $partido->equipovisitante->club->nombre }}</td>
                                                    <td class="text-center"> {{ $partido->fecha_partido }} <br>
                                                        Hora: {{ $partido->hora_partido }}</td>  
                                                    <td> {{ $partido->categoria->nombre }}</td>
                                                    <td>
                                                        @if ($partido->estado)
                                                        <span class="badge badge-success">Pendiente</span>
                                                        @else
                                                        
                                                        <span class="badge badge-danger">Jugado</span>
                                                             
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @can('editar-partido')
                                                            <a href="{{ route('partidos.edit', $partido->id) }}"
                                                                class="btn btn-warning btn-sm" title="Editar partido">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        @endcan

                                                        @can('ver-partido')
                                                            {{-- ver partido --}}
                                                            <a href="{{route('partidos.show',$partido->id)}}"
                                                                class="btn btn-info btn-sm" title="Ver partido">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        

                                                    </td>


                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $partidos->appends(['texto' => "$texto"]) }}

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

    @if (session('create') == 'El partido se creo con exito')
        <script>
            Swal.fire(
                'Registrado!',
                'Se Registró correctamente.',
                'success'
            )
        </script>
    @endif



    @if (session('update') == 'El partido se actualizo con exito')
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
                text: "¡Desea cambiar el estado de la partido!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        '¡Cambiado!',
                        'El estado de la partido ha sido cambiado.',
                        'success'
                    )
                    this.submit();
                }
            })
        });
    </script>





@stop

