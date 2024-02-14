<div class="modal fade" id="mostrar{{ $entrenador->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <div class="modal-header ">
                {{-- <h5 class="modal-title"><b> {{$entrenador->nombre}}</b></h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #8b2424;"> <i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body ">

                    <div class="cont shadow-sm p-2 mb-5 bg-body rounded">
                        
                        <h3 class="card-text text-center"><b> ENTRENADORES </b></h3>
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-primary text-light">Entrenador</th>
                            <td>
                                <b>{{ $entrenador->nombre }} {{ $entrenador->apellido_paterno }} {{ $entrenador->apellido_materno }}</b>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-secondary text-light">Dirección</th>
                            <td>{{ $entrenador->direccion }}</td>
                        </tr>
                        <tr>
                            <th class="bg-primary text-light">Estado</th>
                            <td>
                                @if ($entrenador->estado)
                                    <span class="badge badge-success">El entrenador se encuentra Activo</span>
                                @else
                                    <span class="badge badge-danger">El entrenador se encuentra Finalizado</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-secondary text-light">Equipo</th>
                            <td>
                                <b>{{ $entrenador->dni }}</b>
                            </td>
                        </tr>
                    </table>

                <div style="display: flex; justify-content: center; align-items: center;">
                    <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                        <div style="border: 2px solid #28a745; border-radius: 90%; width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; margin-right: 70px;">
                            <img src="{{ asset('' . $entrenador->firma) }}" alt="Firma" width="50" height="50">
                        </div>
                        <p class="badge badge-success">Firma</p>

                    </div>

                    <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                        <div style="border: 2px solid #28a745; border-radius: 90%; width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; margin-right: 80px;">
                            <img src="{{ asset('' . $entrenador->foto) }}" alt="Foto" width="50">
                        </div>
                        <p class="badge badge-success">Foto</p>
                    </div>
                </div>













                    
                </div>



            </div>
        </div>
    </div>
</div>
