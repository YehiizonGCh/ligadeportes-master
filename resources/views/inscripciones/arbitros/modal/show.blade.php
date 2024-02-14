<!-- Modal "Ver arbitro" -->
<div class="modal fade" id="mostrar{{ $arbitro->id }}" tabindex="-1" role="dialog" aria-labelledby="mostrar{{ $arbitro->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2fb98b; color: #fff;">
                <h5 class="modal-title text-center" id="exampleModalLabel">
                    <i class="fas fa-info-circle"></i> DETALLE DEL ÁRBITRO: {{ $arbitro->nombre }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #f0f0f0;">
                <table class="table table-striped">
                    <tr>
                        <th class="text-center" style="width: 30%;"><i class="fas fa-user"></i> Nombre</th>
                        <td class="text-center">{{ $arbitro->nombre }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-signature"></i> Apellido Paterno</th>
                        <td class="text-center">{{ $arbitro->apellido_paterno }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-signature"></i> Apellido Materno</th>
                        <td class="text-center">{{ $arbitro->apellido_materno }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-birthday-cake"></i> Edad</th>
                        <td class="text-center">{{ $arbitro->edad }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="far fa-id-card"></i> Dni</th>
                        <td class="text-center">{{ $arbitro->dni }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-phone"></i> Telefono</th>
                        <td class="text-center">{{ $arbitro->telefono}}</td>
                    </tr>
                    
                     <tr>
                            <th class="text-center"><i class="fas fa-check-circle"></i> Estado:</th>
                            <td class="text-center">
                                @if ($arbitro->estado)
                                    <span class="badge badge-success"><i class="fas fa-check"></i> Activo</span>
                                @else
                                    <span class="badge badge-danger"><i class="fas fa-times"></i> Inactivo</span>
                                @endif
                            </td>
                        </tr>
                    <!-- Agrega más detalles según sea necesario -->
                </table>
            </div>
            <div class="modal-footer" style="background-color: #2fb98b;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
