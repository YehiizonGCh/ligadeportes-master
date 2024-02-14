<!-- scripts para tablas profesionales-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- scripts para funcionalidad de tabla profesional-->
<script>
$(document).ready(function() {
    $('#tbuser').DataTable({
        "lengthMenu": [[5,10, 50, -1], [5, 10, 50, "All"]]      
        
    });



} );



//funcion para la alerta de eliminar
$('.formulario-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estas Seguro?',
                text: "Estas a punto de eliminar",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        })
</script>



@if(session('delete')=='Registro eliminado correctamente')
        <script>
                    Swal.fire(
                    'Eliminado!',
                    'Se eliminó correctamente.',
                    'error'
                    )
        </script>
        @endif
        @if(session('create')=='Registro agregado correctamente')
        <script>
                    Swal.fire(
                    'Registrado!',
                    'Se Registró correctamente.',
                    'success'
                    )
        </script>
        @endif
        @if(session('update')=='Registro actualizado correctamente')
        <script>
                    Swal.fire(
                    'Actualizado!',
                    'Se Actualizó correctamente.',
                    'success'
                    )
        </script>
    @endif
