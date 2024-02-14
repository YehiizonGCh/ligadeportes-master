<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Partidos </title>

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
        <h2 class="text-center mb-4">Informe de Partidos </h2>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Equipo Local</th>
                    <th>Resultado </th>                                            
                    <th>Equipo Visitante</th> 
                    <th>Fecha y Hora</th>
                    <th >Categoria</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($partidos as $partido)
                    <tr>
                        <td> {{ $partido->equipolocal->club->nombre }}</td>
                       
                        <td> @if ($partido->estado == 1)                                                        
                            VS                                                      
                       @else                                                        
                           {{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->goles_local : 0 }} - {{ $partido->estadisticaspartidos->isNotEmpty() ? $partido->estadisticaspartidos->first()->goles_visitante : 0 }}
                           
                       @endif
                       </td>                        
                                                                         
                       <td> {{ $partido->equipovisitante->club->nombre }}</td>
                       <td class="text-center"> {{ $partido->fecha_partido }} <br>
                        Hora: {{ $partido->hora_partido }}</td>  
                    <td> {{ $partido->categoria->nombre }}</td>
                    <td>
                        @if ($partido->estado)
                        <span class="badge badge-success">Pendiente</span>
                        @else
                        
                        <span class="badge badge-danger">Jugado</span>
                             
                        @endif
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
