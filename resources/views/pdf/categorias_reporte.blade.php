<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Categorias</title>

    <!-- Estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Estilos personalizados -->
    <style>
        body {
            font-size: 12px; /* Ajusta el tamaño de la fuente para el cuerpo del documento */
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
        }
    
        th, td {
            border: 1px solid black;
        }
    
        th {
            background-color: #ffffff;
        }
    
        td {
            padding: 6px; /* Ajusta el relleno de las celdas */
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Informe de Categorias</h2>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Torneo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <td> {{ $categoria->nombre }}</td>
                    <td> {{ $categoria->edad_minima }} - {{ $categoria->edad_maxima }} _Años
                    </td>
                    <td> {{ $categoria->torneos->nombre }}</td>
                    <td>
                        @if ($categoria->estado)
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

    <!-- Scripts y jQuery (si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Puedes incluir otros scripts aquí según sea necesario -->

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
