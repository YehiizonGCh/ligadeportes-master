<!-- Modal "Ver torneo" -->
<div class="modal fade" id="mostrar{{ $torneo->id }}" tabindex="-1" role="dialog" aria-labelledby="mostrar{{ $torneo->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2fb98b; color: #fff;">

                <h5 class="modal-title" id="exampleModalLabel" class="text-center">DETALLE TORNEO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #fcf3f3;">
                <table class="table table-striped">
                    <tr>
                        <th class="text-center" style="width: 30;"><i class="fas fa-font"></i> Nombre</th>
                        <td class="text-center" >{{ $torneo->nombre }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-image"></i> Logo</th>
                        <td class="text-center"><img src="{{ asset('' . $torneo->logo) }}" alt="" width="160"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="far fa-calendar-alt" ></i> Fecha de Inicio</th>
                        <td class="text-center">{{ $torneo->fecha_inicio }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="far fa-calendar-alt" ></i> Fecha de Fin</th>
                        <td class="text-center">{{ $torneo->fecha_fin }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="fas fa-trophy"></i> Liga Deportiva</th>
                        <td class="text-center">{{ $torneo->liga->nombre }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><i class="{{ $torneo->estado ? 'fas fa-check text-success' : 'fas fa-times text-danger' }}"></i> Estado</th>
                        <td class="text-center">{{ $torneo->estado ? 'Activo' : 'Finalizado' }}</td>
                    </tr>
                    <!-- Agrega más detalles según sea necesario -->
                </table>
            </div>
            <div class="modal-footer" style="background-color: #969b99;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff;">Cerrar</button>
            </div>
        </div>
    </div>
</div>
