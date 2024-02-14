@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}"><i
                                    class="fas fa-user-lock  mr-2"></i>Roles</a></li>
                        <li class="breadcrumb-item active">Registro de Roles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')


    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card ">

                    <div class="card-header">
                        <h3 class="card-text"><b> REGISTRAR ROL</b></h3>
                    

                        <div class="card-body">

                            <form method="POST" action="{{ route('roles.store') }}" >
                                @csrf

                            <!-- formulario--->
                            @include('roles.partials.form')

                            </form>

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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
