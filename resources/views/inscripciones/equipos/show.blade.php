@extends('adminlte::page')

@section('title', 'Detalles del Equipo')
@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('equipos.index') }}"><i
                                class="fas fa-users mr-2"></i>Equipos</a></li>
                    <li class="breadcrumb-item active"><i class="fas fa-eye mr-2"></i>Detalles del Equipo</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card responsive">
                    <div class="card-header ">
                        <div class="row text-center">
                            <div class="col-md-6 d-flex align-items-center">
                                <img src="{{ asset('https://cdn-icons-png.flaticon.com/512/2257/2257060.png') }}"
                                    alt="" width="40" height="40" class="mr-2">
                                <h3 class="card-text "><b> DETALLES DEL EQUIPO</b></h3>
                            </div>
                            <div class="col-md-6"> <!-- Alineamos el contenido al centro -->
                                <img src="{{ asset($equipo->club->logo) }}" alt="{{ $equipo->nombre }}" width="50"
                                    height="50" style="border-radius: 10%; border: 2px solid rgb(85, 116, 111);">
                            </div>
                        </div>



                        <div class="card-body">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item-action py-1"><b>NOMBRE DEL EQUIPO: </b> {{ $equipo->nombre }}
                                </li>
                                <li class="list-group-item-action py-1"><b>CLUB:</b> {{ $equipo->club->nombre }}</li>
                                <li class="list-group-item-action py-1"><b>CATEGORIA:</b> {{ $equipo->categoria->nombre }}
                                </li>
                                <li class="list-group-item-action py-1"><b>REPRESENTANTE:</b> {{ $equipo->representante }}
                                </li>
                                <li class="list-group-item-action py-1"><b>ENTRENADOR:</b> {{ $equipo->entrenador->nombre }}
                                    {{ $equipo->entrenador->apellido }}</li>
                            </ul>
                        </div>

                        <!-- Jugadores Inscritos -->
                        <div class="card-body  table-responsive ">
                            <div class="row text-center mb-3">
                                <div class="col-md-12">
                                    <img src="{{ asset('https://cdn-icons-png.flaticon.com/512/2112/2112241.png') }}"
                                        alt="" width="40" height="40" class="mr-2">
                                    <h3 class="mb-0"><b>JUGADORES INSCRITOS</b></h3>
                                </div>
                            </div>
                            
                            

                            <table class="table table-hover table-sm">
                                <thead class="text-white" style="background-color:#6a6b6b">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Foto</th>
                                        <th>Posición</th>
                                        <th>Edad</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($equipo->jugadores as $jugador)
                                        <tr>
                                            <td> {{ $jugador->nombres }} {{ $jugador->apellido_paterno }}
                                                {{ $jugador->apellido_materno }}</td>
                                            <td>
                                                <img src="{{ asset('' . $jugador->foto) }}" alt="{{ $jugador->nombre }}"
                                                    width="30" height="30"
                                                    style="border-radius: 50%; border: 2px solid rgb(82, 125, 118);">
                                            </td>
                                            <td>{{ $jugador->posicion }}</td>
                                            <td>{{ $jugador->edad }} Años</td>
                                            <td>
                                                @if ($jugador->estado == '1')
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Suspendido</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No hay jugadores inscritos en este
                                                equipo.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- paginacion --}}


                        
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i> Editar</a>
                        <a href="{{ route('equipos.index') }}" class="btn btn-secondary"><i
                                class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
