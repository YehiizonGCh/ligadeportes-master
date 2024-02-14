<!-- Modal "Ver liga" -->
<div class="modal fade" id="mostrar{{ $liga->id }}" tabindex="-1" role="dialog" aria-labelledby="mostrar{{ $liga->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" class="text-center" style="background-color: #2fb98b; color: #fff;">
                <h5 class="modal-title text-center" id="exampleModalLabel">
                    <i class="fas fa-info-circle" ></i> DETALLE DE LA LIGA DE {{$liga->nombre}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #f0f0f0;">
                <table class="table table-striped">
                    <tr>
                        <th class="text-center" style="width: 30%;"><i class="fas fa-font"></i> Nombre</th>
                        <td class="text-center">{{ $liga->nombre }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-font"></i> Abreviatura</th>
                        <td class="text-center">{{ $liga->abreviatura }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-align-left"></i> Descripción</th>
                        <td class="text-center">{{ $liga->descripcion }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-image"></i> Logo</th>
                        <td class="text-center"><img src="{{ asset('' . $liga->logo) }}" alt="" width="150"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="{{ $liga->estado ? 'fas fa-check text-success' : 'fas fa-times text-danger' }}"></i> Estado</th>
                        <td class="text-center">{{ $liga->estado ? 'Activo' : 'Finalizado' }}</td>
                    </tr>
                    <!-- Agrega más detalles según sea necesario -->
                </table>
            </div>
            <div class="modal-footer" style="background-color: #2fb98b;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
