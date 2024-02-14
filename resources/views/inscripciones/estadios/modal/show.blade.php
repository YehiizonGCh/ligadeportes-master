<div class="modal fade" id="mostrar{{ $estadio->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2fb98b; color: #fff;">
                <h5 class="modal-title" id="exampleModalLabel">Detalles del Estadio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #f0f0f0;">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th class="text-center"><i class="fas fa-user"></i> Nombre:</th>
                            <td class="text-center">{{ $estadio->nombre }}</td>
                        </tr>
                        <tr>
                            <th class="text-center"><i class="fas fa-map-marker-alt"></i> Dirección:</th>
                            <td class="text-center">{{ $estadio->direccion }}</td>
                        </tr>
                        <tr>
                            <th class="text-center"><i class="fas fa-globe"></i> Departamento:</th>
                            <td class="text-center">{{ $estadio->departamento }}</td>
                        </tr>
                        <tr>
                            <th class="text-center"><i class="fas fa-futbol"></i> Club:</th>
                            <td class="text-center">{{ $estadio->club->nombre }}</td>
                        </tr>
                        <tr>
                            <th class="text-center"><i class="far fa-image"></i> Imagen:</th>
                            <td class="text-center"><img src="{{ asset('' . $estadio->imagen) }}" alt="" width="150"></td>
                        </tr>
                        <tr>
                            <th class="text-center"><i class="fas fa-check-circle"></i> Estado:</th>
                            <td class="text-center">
                                @if ($estadio->estado)
                                    <span class="badge badge-success"><i class="fas fa-check"></i> Activo</span>
                                @else
                                    <span class="badge badge-danger"><i class="fas fa-times"></i> Finalizado</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="background-color: #2fb98b;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff;">Cerrar</button>
            </div>
        </div>
    </div>
</div>
