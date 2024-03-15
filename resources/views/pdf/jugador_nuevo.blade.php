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
        <h2 class="text-center mb-4">Informe de Jugador Inscrito</h2>
        <table class="table">
            <tr>
                <th>Nombre jugador</th>
                <td>{{ $msg['nombres']}}</td>
            </tr>
            <tr>
                <th>Apellido Paterno</th>
                <td>{{ $msg['apellido_paterno']}}</td>
            </tr>
            <tr>
                <th>Apellido Materno</th>
                <td>{{ $msg['apellido_materno']}}</td>
            </tr>
            <tr>
                <th>DNI</th>
                <td>{{ $msg['dni']}}</td>
            </tr>
            <tr>
            <tr>
                <th>Fecha de Nacimiento</th>
                <td>{{ $msg['fecha_nacimiento']}}</td>
            </tr>
            <tr>
                <th>Domicilio</th>
                <td>{{ $msg['domicilio']}}</td>
            </tr>
                <th>Departamento</th>
                <td>{{ $msg['departamento']}}</td>
            </tr>
            <tr>
                <th>Provincia</th>
                <td>{{ $msg['provincia']}}</td>
            </tr>
            <tr>
                <th>Distrito</th>
                <td>{{ $msg['distrito']}}</td>
            </tr>
            <tr>
                <th>Talla</th>
                <td>{{ $msg['talla']}}</td>
            </tr>
            <tr>
                <th>Peso</th>
                <td>{{ $msg['peso']}}</td>
            </tr>
            <tr>
                <th>Dorsal</th>
                <td>{{ $msg['dorsal']}}</td>
            </tr>
            <tr>
                <th>Posicion</th>
                <td>{{ $msg['posicion']}}</td>
            </tr>
        </table>
    </div>

    <!-- Scripts y jQuery (si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Puedes incluir otros scripts aquí según sea necesario -->

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>