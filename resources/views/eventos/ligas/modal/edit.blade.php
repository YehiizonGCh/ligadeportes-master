<div class="modal fade" id="editar{{ $liga->id }}" data-backdrop="static">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content ">
            <div class="modal-header  ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #8b2424;"> <i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="card">
                    <div class="card-header  ">
                        <h3 class="card-text"><b> EDITAR: {{ $liga->nombre }}</b></h3>
                        <div class="card-body ">
                            <form class="row g-3"method="POST"
                                action="{{ route('ligas.update', $liga->id) }}"enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                            value="{{ $liga->nombre }}">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="abreviatura">abreviatura</label>
                                            <input type="text" name="abreviatura" id="abreviatura" class="form-control"
                                            value="{{ $liga->abreviatura}}">
                                            @foreach ($errors->get('abreviatura') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="descripcion">Descripcion</label>
                                            <input type="text" name="descripcion" id="descripcion" class="form-control"
                                            value="{{ $liga->descripcion}}">
                                            @foreach ($errors->get('descripcion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="from-group mb-8">
                                            <label for="logo" class="form-label">logo</label>
                                            {{-- mostrar logo --}}
                                            <img src="{{ asset('' . $liga->logo) }}" alt="" width="100">
                                            <input class="form-control" type="file" id="logo" name="logo"
                                            accept="image/*" value="{{ $liga->logo }}">
                                            @foreach ($errors->get('logo') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-warning">Actualizar</button>

                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
