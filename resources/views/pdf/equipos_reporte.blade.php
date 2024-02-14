<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Equipos</title>

    <!-- Estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Estilos personalizados -->
    <style>
        body {
            font-size: 12px;
            /* Ajusta el tamaño de la fuente para el cuerpo del documento */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* thead-dark */
        thead {
            color: #ffffff;
            background-color: #2fb98b;
            

        }
        thead tr th{
            color: #ffffff;
            background-color: #2fb98b;
        }

        th,
        td {
            border: 1px  ;
            color: #2fb98b;
        }

        th {
            background-color: #ffffff;
        }

        td {
            padding: 6px;
            /* Ajusta el relleno de las celdas */
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="section-body ">

            <h3 class="card-text"><b> EQUIPOS</b></h3>
            <div class="card-body">

                <table class="table  table-hover  shadow p-2 mb-5 bg-body rounded"
                    style="border-radius: 10px; overflow: hidden;">
                    <thead >
                        <tr>
                            <th>Nombre Equipo</th>
                            <th>Club</th>
                            <th>Categoria</th>
                            <th>Representante</th>
                            <th>Entrenador</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($equipos as $equipo)
                            <tr>
                                <td> {{ $equipo->nombre }}</td>
                                <td> {{ $equipo->club->nombre }}</td>
                                <td> {{ $equipo->categoria->nombre }}</td>
                                <td> {{ $equipo->representante }}</td>
                                <td> {{ $equipo->entrenador->nombre }}</td>



                                <td>
                                    @if ($equipo->estado)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Finalizado</span>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <!-- Scripts y jQuery (si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Puedes incluir otros scripts aquí según sea necesario -->

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
