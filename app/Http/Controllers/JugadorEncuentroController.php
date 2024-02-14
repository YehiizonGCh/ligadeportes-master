<?php

namespace App\Http\Controllers;

use App\Models\JugadorEncuentro;
use App\Models\EstadisticaPartido;
use App\Models\Jugador;
use App\Models\Partido;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDF;


class JugadorEncuentroController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-jugador-encuentro|crear-jugador-encuentro|editar-jugador-encuentro|borrar-jugador-encuentro')->only('index');
        $this->middleware('permission:crear-jugador-encuentro', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-jugador-encuentro', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-jugador-encuentro', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $texto = trim($request->get('texto'));
        $jugadorencuentros = JugadorEncuentro::with('jugador', 'partido')
            ->whereHas('jugador', function ($q) use ($texto) {
                $q->where('nombres', 'LIKE', '%' . $texto . '%')
                    ->orWhere('apellido_paterno', 'LIKE', '%' . $texto . '%')
                    ->orWhere('apellido_materno', 'LIKE', '%' . $texto . '%');
            })
            ->orWhereHas('partido', function ($q) use ($texto) {
                $q->where('fecha_partido', 'LIKE', '%' . $texto . '%');
            })
            ->orWhereHas('partido.equipolocal.club', function ($q) use ($texto) {
                $q->where('nombre', 'LIKE', '%' . $texto . '%');
            })
            ->orWhereHas('partido.equipovisitante.club', function ($q) use ($texto) {
                $q->where('nombre', 'LIKE', '%' . $texto . '%');
            })
            ->orderBy('id', 'desc')->paginate(5);
        return view('gestionpartidos.encuentros.index', compact('jugadorencuentros', 'texto'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jugadorencuentro = new JugadorEncuentro();
        $partidos = Partido::where('estado', '=', '0')->get();
        $jugadores = Jugador::where('estado', '=', '1')->get();
        return view('gestionpartidos.encuentros.create', compact('jugadorencuentro', 'partidos', 'jugadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Obtener la estadística del partido
        $estadisticaPartido = EstadisticaPartido::where('partidos_id', $request->partidos_id)->first();

        // Verificar que el número de goles del jugador no sea mayor que los goles registrados para el equipo local y visitante
        $golesEquipoLocal = $estadisticaPartido->goles_local ?? 0;
        $golesEquipoVisitante = $estadisticaPartido->goles_visitante ?? 0;

        $golesJugador = $request->input('goles');
        $autogolesJugador = $request->input('autogoles');

        // Sumar los goles de todos los jugadores registrados en el partido actual
        $golesRegistrados = JugadorEncuentro::where('partidos_id', $request->partidos_id)
          ->sum('goles');

        $autogolesRegistrados = JugadorEncuentro::where('partidos_id', $request->partidos_id)
            ->sum('autogoles');

        // Verificar si el nuevo gol supera el límite establecido para el partido
        if (($golesRegistrados + $golesJugador) > $golesEquipoLocal || ($autogolesRegistrados + $autogolesJugador) > $golesEquipoVisitante) {
            return redirect()->back()->with('errorgol', 'El número de goles del jugador supera el límite establecido para el partido');
        }
        $request->validate([
            'jugadores_id' => 'required',
            'partidos_id' => 'required',
            'titular' => 'required',
            'goles' => 'required',
            'autogoles' => 'required',
            'asistencias' => 'required',
            'amarillas' => 'required',
            'rojas' => 'required',
            'observacion_goles' => 'nullable',
            'observacion_targeta_amarilla' => 'nullable',
            'observacion_targeta_roja' => 'nullable',
            'minuto_gol' => 'nullable|array',
            'minuto_autogol' => 'nullable|array',
        ]);


        $partidoId = $request->input('partidos_id');
        $jugadorId = $request->input('jugadores_id');

        // Verificar si el jugador ya está registrado para el mismo partido y equipo
        if (
            JugadorEncuentro::where('partidos_id', $partidoId)
                ->where('jugadores_id', $jugadorId)
                ->exists()
        ) {
            return redirect()->route('encuentros.create')
                ->with('errorjugador', '¡El jugador ya está registrado para este partido y equipo!');
        }

        // Crear un nuevo registro en la tabla jugadorencuentros
        JugadorEncuentro::create([
            'jugadores_id' => $request->input('jugadores_id'),
            'partidos_id' => $request->input('partidos_id'),
            'titular' => $request->input('titular'),
            'goles' => $request->input('goles'),
            'autogoles' => $request->input('autogoles'),
            'asistencias' => $request->input('asistencias'),
            'amarillas' => $request->input('amarillas'),
            'rojas' => $request->input('rojas'),
            'observacion_goles' => $request->input('observacion_goles'),
            'observacion_targeta_amarilla' => $request->input('observacion_targeta_amarilla'),
            'observacion_targeta_roja' => $request->input('observacion_targeta_roja'),
            'minuto_gol' => 'nullable|array',
            'minuto_autogol' => 'nullable|array',
        ]);

        // Verificar si se recibió una tarjeta roja
        $tarjetasRojas = $request->input('rojas');
        if ($tarjetasRojas > 0) {
            // Cambiar el estado del jugador a inactivo
            $jugador = Jugador::find($request->jugadores_id);
            $jugador->estado = 0; // 0 significa inactivo
            $jugador->save();
        }

        return redirect()->route('encuentros.index')->with('create', 'El jugador se registro con exito');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $jugadorencuentro = JugadorEncuentro::findOrFail($id);
        $partidos = Partido::all();
        
        return view('gestionpartidos.encuentros.show', compact('jugadorencuentro', 'partidos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $jugadorencuentro = JugadorEncuentro::findOrFail($id);
        $partidos = Partido::where('estado', '=', '0')->get();
        $jugadores = Jugador::all();
        $otrojugador = Jugador::where('estado', '=', '1')->where('id', '!=', $jugadorencuentro->jugadores_id)->get();

        return view('gestionpartidos.encuentros.edit', compact('jugadorencuentro', 'partidos', 'jugadores', 'otrojugador'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Obtener el jugadorencuentro
        $jugadorencuentro = JugadorEncuentro::findOrFail($id);
        // Verificar si el número de goles se cambió a 0
        $nuevosGoles = $request->input('goles');

        if ($nuevosGoles == 0) {
            // Elimina los minutos de gol si el nuevo valor de goles es 0
            $jugadorencuentro->minuto_gol = null;
        }
        
        $jugadorencuentro->goles = $nuevosGoles;
        // Resto de la lógica de actualización...
        
        // Verificar que el número de goles del jugador no sea mayor que los goles registrados para el equipo local y visitante
        $estadisticaPartido = EstadisticaPartido::where('partidos_id', $request->partidos_id)->first();
       // Verificar que el número de goles del jugador no sea mayor que los goles registrados para el equipo local y visitante
       $golesEquipoLocal = $estadisticaPartido->goles_local ?? 0;
       $golesEquipoVisitante = $estadisticaPartido->goles_visitante ?? 0;

       $golesJugador = $request->input('goles');
       $autogolesJugador = $request->input('autogoles');

       // Sumar los goles de todos los jugadores registrados en el partido actual
       $golesRegistrados = JugadorEncuentro::where('partidos_id', $request->partidos_id)
         ->sum('goles');

       $autogolesRegistrados = JugadorEncuentro::where('partidos_id', $request->partidos_id)
           ->sum('autogoles');

       // Verificar si el nuevo gol supera el límite establecido para el partido
       if (($golesRegistrados + $golesJugador) > $golesEquipoLocal || ($autogolesRegistrados + $autogolesJugador) > $golesEquipoVisitante) {
           return redirect()->back()->with('errorgol', 'El número de goles del jugador supera el límite establecido para el partido');
       }

        // Validar los datos del formulario
        $request->validate([
            'jugadores_id' => 'required_if:rojas,>0',
            'partidos_id' => 'required',
            'titular' => 'required',
            'goles' => 'required|numeric|min:0|max:10',
            'autogoles' => 'required',
            'asistencias' => 'required',
            'amarillas' => 'required',
            'rojas' => 'required',
            'observacion_goles' => 'nullable',
            'observacion_targeta_amarilla' => 'nullable',
            'observacion_targeta_roja' => 'nullable',
        ]);

        // Actualizar los datos del jugadorencuentro
        $jugadorencuentro->fill($request->all());
        
        $jugadorencuentro->update();

        // Verificar si se recibió una tarjeta roja
        $tarjetasRojas = $request->input('rojas');
        if ($tarjetasRojas > 0) {
            // Cambiar el estado del jugador a inactivo
            $jugador = Jugador::find($jugadorencuentro->jugadores_id);
            $jugador->estado = 0; // 0 significa inactivo
            $jugador->update();
        } else {
            // Si se eliminó la tarjeta roja, cambiar el estado del jugador a activo
            $jugador = Jugador::find($jugadorencuentro->jugadores_id);
            $jugador->estado = 1; // 1 significa activo
            $jugador->update();
        }

        return redirect()->route('encuentros.index')->with('update', 'El jugador se actualizo con exito');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $jugadorEncuentro = JugadorEncuentro::find($id);

    if (!$jugadorEncuentro) {
        // Handle the case where the JugadorEncuentro is not found
        return redirect()->route('encuentros.index')->with('error', 'JugadorEncuentro not found');
    }

    $jugador = Jugador::find($jugadorEncuentro->jugadores_id);

    if ($jugador && $jugador->estado == 1) {
        DB::table('jugadors')->where('id', $jugador->id)->update(['estado' => 0]);
        return redirect()->route('encuentros.index');
    }

    if ($jugador) {
        DB::table('jugadors')->where('id', $jugador->id)->update(['estado' => 1]);
        return redirect()->route('encuentros.index');
    }

    // Handle the case where Jugador is not found
    return redirect()->route('encuentros.index')->with('error', 'Jugador not found');
}



    public function obtenerJugadoresPorPartidoYEquipo($partidoId, $equipo)
    {
        try {
            // Utiliza la relación 'jugadores' a través de la relación 'equipolocal' o 'equipovisitante'
            $partido = Partido::find($partidoId);

            if (!$partido) {
                return response()->json(['error' => 'Partido no encontrado.'], 404);
            }

            $relacionEquipos = $equipo === 'local' ? 'equipolocal' : 'equipovisitante';

            // Verifica si el equipo existe en el partido
            if (!$partido->$relacionEquipos) {
                return response()->json(['error' => 'Equipo no encontrado en el partido.'], 404);
            }

            $jugadores = $partido->$relacionEquipos->jugadores;

            return response()->json($jugadores);
        } catch (QueryException $e) {
            // Loguea el error o devuelve una respuesta JSON con un mensaje de error
            return response()->json(['error' => 'Error en la consulta de la base de datos'], 500);
        }
    }



    public function verificarRegistro(Request $request)
    {
        $partidoId = $request->input('partidoId');
        $jugadorId = $request->input('jugadorId');

        // Verificar si el jugador ya está registrado para el mismo partido y equipo
        if (
            JugadorEncuentro::where('partidos_id', $partidoId)
                ->where('jugadores_id', $jugadorId)
                ->exists()
        ) {
            return redirect()->back()->with('error', 'El jugador ya está registrado para este partido y equipo');
        }

        // Puedes redirigir a donde sea necesario si el jugador es válido
        return redirect()->back()->with('success', 'Jugador válido');
    }

    public function generarInformeencuentroPDF()
    {   
        $jugadorencuentros = JugadorEncuentro::with('jugador', 'partido') 
        ->orderBy('id', 'desc')->get();
        $data = [
            'jugadorencuentros' => $jugadorencuentros,
        ];
    
        $pdf = PDF::loadView('pdf.jugadorencuentro_reporte', $data);
    
        return $pdf->download('jugadorencuentros_reporte.pdf');
    }

    


    
}
