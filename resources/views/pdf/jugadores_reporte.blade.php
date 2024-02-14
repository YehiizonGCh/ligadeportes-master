<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Jugadores</title>

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
        <h2 class="text-center mb-4">Informe de Jugadores</h2>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre jugador</th>
                    <th>DNI</th>  
                    <th>Equipo</th>
                    <th>Posicion</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jugadores as $jugador)
                <tr>
                    <td> {{ $jugador->nombres }} {{ $jugador->apellido_paterno }} {{ $jugador->apellido_materno }}</td>
                    <td> {{ $jugador->dni }}</td>
                
                    <td> {{ $jugador->equipos->nombre }}</td>
                    <td> {{ $jugador->posicion }}</td>
                        
                    <td>
                        @if ($jugador->estado)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Suspendido</span>
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
