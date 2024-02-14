<div class="modal fade" id="editar{{ $arbitro->id }}" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #8b2424;"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text"><b>BIENVENIDO:{{ $arbitro->nombre }} {{$arbitro->apellido_paterno}} {{$arbitro->apellido_materno}}</b></h3>
                    </div>
                    <div class="card-body ">
                        <form method="POST" action="{{ route('arbitros.update', $arbitro->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre"><i class="fas fa-user"></i> Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $arbitro->nombre }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_paterno"><i class="fas fa-user"></i> Apellido Paterno</label>
                                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="{{ $arbitro->apellido_paterno }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_materno"><i class="fas fa-user"></i> Apellido Materno</label>
                                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="{{ $arbitro->apellido_materno }}">
                                    </div>
                                </div>
                                

                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dni"><i class="fas fa-id-card"></i> DNI</label>
                                        <input type="number" name="dni" id="dni" class="form-control" value="{{ $arbitro->dni }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="from-group">
                                        <label for="edad">Edad</label>
                                        <input type="number" name="edad" id="edad" class="form-control"
                                            value="{{ $arbitro->edad }}">
                                        @foreach ($errors->get('edad') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono"><i class="fas fa-phone"></i> Teléfono</label>
                                        <input type="number" name="telefono" id="telefono" class="form-control" value="{{ $arbitro->telefono }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_arbitro"><i class="fas fa-user-tie"></i> Tipo de Árbitro</label>
                                        <input type="text" name="tipo_arbitro" id="tipo_arbitro" class="form-control" value="{{ $arbitro->tipo_arbitro }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                        <a href="{{ route('arbitros.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
                                    </div>
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Código HTML del modal -->

