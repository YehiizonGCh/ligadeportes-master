@if (isset($entrenador))

    <div class="modal fade" id="editar{{ $entrenador->id }}" data-backdrop="static">
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
                            <h3 class="card-text" style="text-transform: uppercase; text-align: center;"><b>
                                    {{ $entrenador->nombre }}</b></h3>

                            <div class="card-body ">
                                @if ($entrenador)
                                    <form class="row g-3"method="POST"
                                        action="{{ route('entrenadores.update', $entrenador->id) }}"enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row ">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dni">Dni</label>
                                                    <input type="text" name="dni" id="dni"
                                                        class="form-control" value="{{ $entrenador->dni }}">
                                                    @foreach ($errors->get('dni') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="apellido_materno">Apellido Materno</label>
                                                    <input type="text" name="apellido_materno" id="apellido_materno"
                                                        class="form-control"
                                                        value="{{ $entrenador->apellido_materno }}">
                                                    @foreach ($errors->get('apellido_materno') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="apellido_paterno">Apellido Paterno</label>
                                                    <input type="text" name="apellido_paterno" id="apellido_paterno"
                                                        class="form-control"
                                                        value="{{ $entrenador->apellido_paterno }}">
                                                    @foreach ($errors->get('apellido_paterno') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" name="nombre" id="nombre"
                                                        class="form-control" value="{{ $entrenador->nombre }}">
                                                    @foreach ($errors->get('nombre') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="col-md-m4">
                                                <div class="form-group">
                                                    <label for="direccion">Direccion</label>
                                                    <input type="text" name="direccion" id="direccion"
                                                        class="form-control" value="{{ $entrenador->direccion }}">
                                                    @foreach ($errors->get('direccion') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firma">Firma</label>
                                                    <div class="card border-primary">
                                                        <div class="card-body" style="text-align: center;">
                                                            <label for="firma" id="icon-image-firma"
                                                                class="btn btn-primary"
                                                                style="display: block;background-color: #2fb98b; "><i
                                                                    class="fas fa-image"></i></label>
                                                            <span id="icon-cerrar-firma"></span>
                                                            <input id="firma" class="d-none" type="file"
                                                                name="firma" onchange="previsualizacionImage(event)"
                                                                accept="image/*">
                                                            @foreach ($errors->get('firma') as $error)
                                                                <span
                                                                    class="text text-danger">{{ $error }}</span>
                                                            @endforeach
                                                            <input type="hidden" id="firma_actual" name="firma_actual"
                                                                value="{{ $entrenador->firma }}">
                                                            <img id="img-preview-firma"
                                                                style="max-width: 100%; max-height: 100px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="foto">Foto</label>
                                                    <div class="card border-primary">
                                                        <div class="card-body" style="text-align: center;">
                                                            <label for="foto" id="icon-image-foto"
                                                                class="btn btn-primary"
                                                                style="display: block;background-color: #2fb98b; "><i
                                                                    class="fas fa-image"></i></label>
                                                            <span id="icon-cerrar-foto"></span>
                                                            <input id="foto" class="d-none" type="file"
                                                                name="foto" onchange="previsualizacionFoto(event)"
                                                                accept="image/*">
                                                            @foreach ($errors->get('foto') as $error)
                                                                <span
                                                                    class="text text-danger">{{ $error }}</span>
                                                            @endforeach
                                                            <input type="hidden" id="foto_actual" name="foto_actual"
                                                                value="{{$entrenador->foto}}">
                                                            <img id="img-preview-foto"
                                                                style="max-width: 100%; max-height: 100px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-warning"><i
                                                        class="fas fa-save"></i> Actualizar</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                                        class="fas fa-times"></i> Cancelar</button>
                                            </div>

                                        </div>
                                    </form>
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        No se encontro ningun registro
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

        <script>
            window.onload = function() {
                var firma_actual = document.getElementById('firma_actual').value;
                if (firma_actual) {
                    var imgPreview = document.getElementById('img-preview-firma');
                    imgPreview.setAttribute('src', firma_actual);
                }

                var foto_actual = document.getElementById('foto_actual').value;
                if (foto_actual) {
                    var imgPreviewFoto = document.getElementById('img-preview-foto');
                    imgPreviewFoto.setAttribute('src', foto_actual);
                }
            };

            function previsualizacionImage(event) {
                var input = event.target;
                var imgPreview = document.getElementById('img-preview-firma');
                var iconCerrar = document.getElementById('icon-cerrar-firma');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        imgPreview.setAttribute('src', e.target.result);
                        iconCerrar.innerHTML =
                            '<i class="fas fa-times-circle text-danger" onclick="borrarPrevisualizacion()"></i>';
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    imgPreview.src = '';
                    iconCerrar.innerHTML = '';
                }
            }

            function borrarPrevisualizacion() {
                var imgPreview = document.getElementById('img-preview-firma');
                var iconCerrar = document.getElementById('icon-cerrar-firma');
                var input = document.getElementById('firma');

                imgPreview.src = '';
                iconCerrar.innerHTML = '';
                input.value = '';
            }

            function previsualizacionFoto(event) {
                var input = event.target;
                var imgPreview = document.getElementById('img-preview-foto');
                var iconCerrar = document.getElementById('icon-cerrar-foto');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        imgPreview.setAttribute('src', e.target.result);
                        iconCerrar.innerHTML =
                            '<i class="fas fa-times-circle text-danger" onclick="borrarPrevisualizacionFoto()"></i>';
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    imgPreview.src = '';
                    iconCerrar.innerHTML = '';
                }
            }

            function borrarPrevisualizacionFoto() {
                var imgPreview = document.getElementById('img-preview-foto');
                var iconCerrar = document.getElementById('icon-cerrar-foto');
                var input = document.getElementById('foto');

                imgPreview.src = '';
                iconCerrar.innerHTML = '';
                input.value = '';
            }
        </script>
    @else
        <div class="alert alert-danger" role="alert">
            No se encontro ningun registro
        </div>
    @endif
