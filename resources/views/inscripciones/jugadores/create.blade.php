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
                        <li class="breadcrumb-item"><a href="{{ route('jugadores.index') }}"><i
                                    class="fas fa-user  mr-2"></i>Jugadores</a></li>
                        <li class="breadcrumb-item active">Registro de Jugadores</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-text"><b><img src="https://cdn-icons-png.flaticon.com/512/2112/2112241.png" alt="jugador de fútbol" title="jugador de fútbol" width="50" height="50">
                        REGISTRO DE JUGADORES</b></h3>
                        <div class="card-body ">
                            <form method="POST" action="{{ route('jugadores.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="col-md-12 card-header border-primary mb-2"> 
                                            <h3 class="card-title">
                                                <i class="fas fa-user" style="margin-right: 10px; color: #2fb98b;"></i> DATOS DEL JUGADOR
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido_paterno">Apellido Paterno</label>
                                            <input type="text" name="apellido_paterno" id="apellido_paterno"
                                                class="form-control" value="{{ old('apellido_paterno') }}">
                                            @foreach ($errors->get('apellido_paterno') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido_materno">Apellido Materno</label>
                                            <input type="text" name="apellido_materno" id="apellido_materno"
                                                class="form-control" value="{{ old('apellido_materno') }}">
                                            @foreach ($errors->get('apellido_materno') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombres">Nombres</label>
                                            <input type="text" name="nombres" id="nombres" class="form-control"
                                                value="{{ old('nombres') }}">
                                            @foreach ($errors->get('nombres') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dni">DNI</label>
                                            <input type="number" name="dni" id="dni" class="form-control"
                                                value="{{ old('dni') }}">
                                            @foreach ($errors->get('dni') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                                class="form-control" value="{{ old('fecha_nacimiento') }}">
                                            @foreach ($errors->get('fecha_nacimiento') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Edad</label>
                                            {{-- no modificable --}}
                                            <input type="text" name="edad" id="edad" class="form-control"
                                                value="{{ old('edad') }}" >
                                            @foreach ($errors->get('edad') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado_civil">Estado Civil</label>
                                            <select name="estado_civil" id="estado_civil" class="form-control">
                                                <option disabled selected>Seleccione</option>
                                                {{-- opciones --}}
                                                <option value="Soltero" @if (old('estado_civil') == 'Soltero') selected @endif>
                                                    Soltero</option>
                                                <option value="Casado" @if (old('estado_civil') == 'Casado') selected @endif>
                                                    Casado</option>
                                            </select>
                                            @foreach ($errors->get('estado_civil') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Domicilio</label>
                                            <input type="text" name="domicilio" id="domicilio" class="form-control"
                                                value="{{ old('domicilio') }}">
                                            @foreach ($errors->get('domicilio') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="foto">Foto</label>
                                            <div class="card border-primary">
                                                <div class="card-body" style="text-align: center;">
                                                    <label for="foto" id="icon-image" class="btn btn-primary"
                                                        style="display: block; background-color: #2fb98b;"><i class="fas fa-image"></i></label>
                                                    <span id="icon-cerrar"></span>
                                                    <input id="foto" class="d-none" type="file" name="foto"
                                                        onchange="previsualizacionImage(event)" accept="image/*">
                                                    @foreach ($errors->get('foto') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                    <input type="hidden" id="foto_actual" name="foto_actual"
                                                        value="{{ old('foto_actual') }}">
                                                    <img id="img-preview" style="max-width: 100%; max-height: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12 card-header border-primary mb-2">
                                            <h3 class="card-title">
                                                <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: #2fb98b;"></i> LUGAR DE
                                                NACIMIENTO
                                            </h3>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="departamento">Departamento</label>
                                            <input type="text" name="departamento" id="departamento" class="form-control"
                                                value="{{ old('departamento') }}">
                                            @foreach ($errors->get('departamento') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provincia">Provincia</label>
                                            <input type="text" name="provincia" id="provincia" class="form-control"
                                                value="{{ old('provincia') }}">
                                            @foreach ($errors->get('provincia') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="distrito">Distrito</label>
                                            <input type="text" name="distrito" id="distrito" class="form-control"
                                                value="{{ old('distrito') }}">
                                            @foreach ($errors->get('distrito') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12 card-header border-primary mb-2">
                                            <h3 class="card-title">
                                                <i class="fas fa-user" style="margin-right: 10px; color: #2fb98b;"></i> DATOS DEL
                                                APODERADO
                                            </h3>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre del Padre</label>
                                            <input type="text" name="nombre_padre" id="nombre_padre"
                                                class="form-control" value="{{ old('nombre_padre') }}">
                                            @foreach ($errors->get('nombre_padre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre de la Madre</label>
                                            <input type="text" name="nombre_madre" id="nombre_madre"
                                                class="form-control" value="{{ old('nombre_madre') }}">
                                            @foreach ($errors->get('nombre_madre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="documentos">Documento de Autorización del apoderado</label>
                                            <div class="card border-primary">
                                                <div class="card-body" style="text-align: center;">
                                                    <!-- Icono de documento como marcador de posición -->
                                                    <label for="documentos" id="icon-document" class="btn btn-primary"
                                                        style="display: block; background-color: #2fb98b;"><i
                                                            class="far fa-file"></i> Seleccione un archivo</label>
                                                    <span id="icon-cerrar"></span>
                                                    <input id="documentos" class="d-none" type="file" name="documentos"
                                                        accept=".pdf, .doc, .docx"
                                                        onchange="previsualizacionDocumento(event)">
                                                    @foreach ($errors->get('documentos') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                    <input type="hidden" id="documento_actual" name="documento_actual"
                                                        value="{{ old('documento_actual') }}">
                                                    <!-- Enlace para ver o descargar el documento -->
                                                    <a id="ver-documento" href="#" target="_blank"
                                                        style="display: none;"><i class="far fa-file-pdf"></i> Ver documento</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12 card-header border-primary mb-2">
                                            <h3 class="card-title">
                                                <i class="fas fa-futbol" style="margin-right: 10px; color: #2fb98b;"></i> INFORMACION DEL
                                                JUGADOR

                                            </h3>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="trabaja">Trabaja</label>
                                            <select name="trabaja" id="trabaja" class="form-control">
                                                <option disabled selected>Seleccione </option>
                                                <option value="Si" @if (old('trabaja') == 'Si') selected @endif>Si
                                                </option>
                                                <option value="No" @if (old('trabaja') == 'No') selected @endif>No
                                                </option>

                                            </select>
                                            @foreach ($errors->get('trabaja') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="estudia">Estudia</label>
                                            <select name="estudia" id="estudia" class="form-control">
                                                <option disabled selected>Seleccione</option>
                                                <option value="Si" @if (old('estudia') == 'Si') selected @endif>Si
                                                </option>
                                                <option value="No" @if (old('estudia') == 'No') selected @endif>No
                                                </option>
                                            </select>
                                            @foreach ($errors->get('estudia') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="talla">Talla</label>
                                            <input type="text" name="talla" id="talla" class="form-control"
                                                value="{{ old('talla') }}">
                                            @foreach ($errors->get('talla') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="peso">Peso</label>
                                            <input type="text" name="peso" id="peso" class="form-control"
                                                value="{{ old('peso') }}">
                                            @foreach ($errors->get('peso') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ficha_medica">Ficha Médica</label>
                                            <div class="card border-primary">
                                                <div class="card-body" style="text-align: center;">
                                                    <label for="ficha_medica" id="icon-ficha" class="btn btn-primary"
                                                        style="display: block; background-color: #2fb98b;"><i class="far fa-file"></i> Seleccione un
                                                        archivo</label>
                                                    <span id="ficha-info"></span>
                                                    <input id="ficha_medica" class="d-none" type="file"
                                                        name="ficha_medica" accept=".pdf, .doc, .docx"
                                                        onchange="previsualizacionFicha(event)">
                                                    @foreach ($errors->get('ficha_medica') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                    <input type="hidden" id="ficha_actual" name="ficha_actual"
                                                        value="{{ old('ficha_actual') }}">
                                                    <!-- Enlace para ver la ficha médica -->
                                                    <a id="ver-ficha" href="#" target="_blank"
                                                        style="display: none;"><i class="far fa-file-pdf"></i> Ver ficha médica</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Grupo Sanguineo</label>
                                            <input type="text" name="grupo_sanguineo" id="grupo_sanguineo"
                                                class="form-control" value="{{ old('grupo_sanguineo') }}">
                                            @foreach ($errors->get('grupo_sanguineo') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12 card-header border-primary mb-2">
                                            <h3 class="card-title">
                                                <i class="fas fa-futbol" style="margin-right: 10px; color: #2fb98b;"></i> EQUIPO A
                                                REGISTRARSE

                                            </h3>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="posicion">Posicion</label>
                                            <select name="posicion" id="posicion" class="form-control">
                                                <option value="" disabled selected>Seleccionar</option>
                                                <option value="Arquero" @if (old('posicion') == 'Arquero') selected @endif>
                                                    Arquero</option>
                                                <option value="Defensa" @if (old('posicion') == 'Defensa') selected @endif>
                                                    Defensa</option>
                                                <option value="Mediocampista"
                                                    @if (old('posicion') == 'Mediocampista') selected @endif>Medio Campista
                                                </option>
                                                <option value="Delantero"
                                                    @if (old('posicion') == 'Delantero') selected @endif>Delantero</option>

                                            </select>
                                            @foreach ($errors->get('posicion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Dorsal</label>
                                            <input type="number" name="dorsal" id="dorsal" class="form-control"
                                                value="{{ old('dorsal') }}">
                                            @foreach ($errors->get('dorsal') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Equipo de Origen</label>
                                            <select name="club_origen" id="club_origen" class="form-control"
                                                value="{{ old('club_origen') }}">
                                                <option value="" disabled selected>Selecciona</option>
                                                @foreach ($equipos as $equipo)
                                                    <option value="{{ $equipo->nombre }}">{{ $equipo->nombre }}- {{ $equipo->club->nombre }} </option>
                                                @endforeach
                                                @foreach ($errors->get('club_origen') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="equipos_id">Equipo</label>
                                            <select name="equipos_id" id="equipos_id" class="form-control" >
                                                <option value="" disabled selected>Selecciona un Equipo</option>
                                                @foreach ($equipos as $equipo)
                                                    <option value="{{ $equipo->id }}"
                                                        data-edad-min="{{ $equipo->categoria->edad_minima }}"
                                                        data-edad-max="{{ $equipo->categoria->edad_maxima }}">
                                                        {{ $equipo->nombre }}--{{ $equipo->club->nombre }}
                                                    </option>                                                    

                                                @endforeach
                                                @foreach ($errors->get('equipos_id') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                                
                                                


                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                            Guardar</button>
                                            <a href="{{ route('jugadores.index') }}" class="btn btn-secondary"><i
                                            class="fas fa-ban"></i> Cancelar</a>
                                        <!-- <a href="{{ route('jugadores.index') }}" class="btn btn-secondary"><i -->          
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Agregar un evento para calcular la edad en tiempo real
        document.getElementById('fecha_nacimiento').addEventListener('input', function() {
            const fechaNacimiento = new Date(this.value);
            const hoy = new Date();
            const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();

            // Actualizar el campo de edad
            document.getElementById('edad').value = edad;
        });
    </script>

    <script>
        $('#equipos_id').change(function() {
            const selectedOption = $(this).find(':selected');
            const edadMinima = parseInt(selectedOption.data('edad-min'));
            const edadMaxima = parseInt(selectedOption.data('edad-max'));
            const fechaNacimiento = new Date($('#fecha_nacimiento').val());
            const hoy = new Date();
            const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            let mensaje = '';

            if (edad >= edadMinima && edad <= edadMaxima) {
                mensaje = 'El jugador cumple con los requisitos de edad.';
                // mostrar alerta de SweetAlert con icono succes
                Swal.fire({
                    title: 'Éxito',
                    text: mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                });
            } else {
                mensaje = 'El jugador no cumple con los requisitos de edad para este equipo.';

                // Muestra una alerta de SweetAlert con icono error
                Swal.fire({
                    title: 'Error',
                    text: mensaje,
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                });
            }


        });
    </script>
    <script>
    function previsualizacionDocumento(event) {
        var input = event.target;
        var documentoInfo = document.getElementById('documento-info');
        var iconDocumento = document.getElementById('icon-document');
        var verDocumentoLink = document.getElementById('ver-documento');

        if (input.files && input.files[0]) {
            var nombreArchivo = input.files[0].name;

            // Cambia el contenido del marcador de posición
            iconDocumento.innerHTML = '<i class="far fa-file"></i> ' + nombreArchivo;

            // Muestra el enlace para ver o descargar el documento
            verDocumentoLink.style.display = 'inline-block';

            // Configura el enlace para abrir o descargar el documento seleccionado
            var documentoURL = URL.createObjectURL(input.files[0]);
            verDocumentoLink.href = documentoURL;
            verDocumentoLink.download = nombreArchivo; // Agrega el atributo "download" para descargar el documento
        } else {
            // Restaura el marcador de posición si no se selecciona ningún archivo
            iconDocumento.innerHTML = '<i class="far fa-file"></i> Seleccione un documento';
            documentoInfo.textContent = '';

            // Oculta el enlace para ver o descargar el documento
            verDocumentoLink.style.display = 'none';
        }
    }

    function borrarPrevisualizacionDocumento() {
        var input = document.getElementById('documentos');
        var documentoInfo = document.getElementById('documento-info');

        input.value = ''; // Esto limpia el valor del input file
        documentoInfo.textContent = '';
    }
</script>


    <script>
        function previsualizacionFicha(event) {
            var input = event.target;
            var fichaInfo = document.getElementById('ficha-info');
            var iconFicha = document.getElementById('icon-ficha');
            var verFichaLink = document.getElementById('ver-ficha');

            if (input.files && input.files[0]) {
                var nombreArchivo = input.files[0].name;

                // Cambia el contenido del marcador de posición
                iconFicha.innerHTML = '<i class="far fa-file"></i> ' + nombreArchivo;

                // Muestra el enlace para ver o descargar la ficha médica
                verFichaLink.style.display = 'inline-block';

                // Configura el enlace para abrir o descargar la ficha médica seleccionada
                var fichaURL = URL.createObjectURL(input.files[0]);
                verFichaLink.href = fichaURL;
                verFichaLink.download = nombreArchivo; // Agrega el atributo "download" para descargar la ficha médica
            } else {
                // Restaura el marcador de posición si no se selecciona ningún archivo
                iconFicha.innerHTML = '<i class="far fa-file"></i> Seleccione un archivo';
                fichaInfo.textContent = '';

                // Oculta el enlace para ver o descargar la ficha médica
                verFichaLink.style.display = 'none';
            }
        }

        function borrarPrevisualizacionFicha() {
            var input = document.getElementById('ficha_medica');
            var fichaInfo = document.getElementById('ficha-info');

            input.value = ''; // Esto limpia el valor del input file
            fichaInfo.textContent = '';
        }
    </script>

    <script>
        const select = document.getElementById('equipos_id');

        select.addEventListener('change', function() {
            if (select.dataset.error) {
                const errorElement = document.createElement('span');
                errorElement.textContent = select.dataset.error;
                errorElement.classList.add('text-danger');

                const parent = select.parentElement;
                parent.appendChild(errorElement);
            } else {
                const errorElement = select.querySelector('.text-danger');
                errorElement.remove();
            }
        });
    </script>
    <script>
        // Cuando se carga la página, verifica si hay una imagen previamente seleccionada
        window.onload = function() {
            var foto_actual = document.getElementById('foto_actual').value;
            if (foto_actual) {
                var imgPreview = document.getElementById('img-preview');
                imgPreview.setAttribute('src', foto_actual);
            }
        };

        function previsualizacionImage(event) {
            var input = event.target;
            var imgPreview = document.getElementById('img-preview');
            var iconCerrar = document.getElementById('icon-cerrar');

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
            var imgPreview = document.getElementById('img-preview');
            var iconCerrar = document.getElementById('icon-cerrar');
            var input = document.getElementById('foto');

            imgPreview.src = '';
            iconCerrar.innerHTML = '';
            input.value = ''; // Esto limpia el valor del input file
        }
    </script>
@stop
