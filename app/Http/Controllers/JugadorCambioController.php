<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\JugadorCambio;
use Illuminate\Http\Request;
use App\Models\Partido;
use App\Models\Jugador;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\View;


class JugadorCambioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-jugador-cambio|crear-jugador-cambio|editar-jugador-cambio|borrar-jugador-cambio')->only('index');
        $this->middleware('permission:crear-jugador-cambio', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-jugador-cambio', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-jugador-cambio', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $fecha_inicial = $request->get('fecha_inicial');
        $fecha_final = $request->get('fecha_final');

        $query = JugadorCambio::with(['partido', 'jugadorEntra', 'jugadorSale'])
            ->orderBy('id', 'desc');

        // Agregar las condiciones de fecha si se proporcionan
        if ($fecha_inicial && $fecha_final) {
            $query->whereHas('partido', function ($q) use ($fecha_inicial, $fecha_final) {
                $q->whereBetween('fecha_partido', [$fecha_inicial, $fecha_final]);
            });
        }

        // Aplicar la búsqueda general
        if ($texto) {
            $query->where(function ($q) use ($texto) {
                $q->whereHas('jugadorEntra', function ($q) use ($texto) {
                    $q->where('nombres', 'LIKE', '%' . $texto . '%')
                        ->orWhere('apellido_paterno', 'LIKE', '%' . $texto . '%')
                        ->orWhere('apellido_materno', 'LIKE', '%' . $texto . '%');
                })
                ->orWhereHas('jugadorSale', function ($q) use ($texto) {
                    $q->where('nombres', 'LIKE', '%' . $texto . '%')
                        ->orWhere('apellido_paterno', 'LIKE', '%' . $texto . '%')
                        ->orWhere('apellido_materno', 'LIKE', '%' . $texto . '%');
                })
                ->orWhereHas('partido.equipolocal.club', function ($q) use ($texto) {
                    $q->where('nombre', 'LIKE', '%' . $texto . '%');
                })
                ->orWhereHas('partido.equipovisitante.club', function ($q) use ($texto) {
                    $q->where('nombre', 'LIKE', '%' . $texto . '%');
                })
                
               
                ->orWhereHas('partido', function ($q) use ($texto) {
                    $q->where('fecha_partido', 'LIKE', '%' . $texto . '%');
                });
            });
        }

        $jugadorcambios = $query->paginate(5);

        return view('gestionpartidos.cambios.index', compact('jugadorcambios', 'texto', 'fecha_inicial', 'fecha_final'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cambios = JugadorCambio::with('partido')->get();
        $partidos = Partido::where('estado', '=', '0')->get();
        $jugadores = Jugador::all();


        return view('gestionpartidos.cambios.create', compact('cambios', 'partidos', 'jugadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'partidos_id' => 'required',
            'jugador_entra_id' => 'required',
            'jugador_sale_id' => 'required',
            'minuto_cambio' => 'required|numeric',
            'observacion_cambio' => 'nullable|string',
        ]);

        $partidoId = $request->input('partidos_id');
        $jugadorEntraId = $request->input('jugador_entra_id');
        $jugadorSaleId = $request->input('jugador_sale_id');

        // Verificar si ya existe un registro con los mismos jugadores en el mismo partido
        $existingCambio = JugadorCambio::where('partidos_id', $partidoId)
            ->where(function ($query) use ($jugadorEntraId, $jugadorSaleId) {
                $query->where('jugador_entra_id', $jugadorEntraId)
                    ->orWhere('jugador_sale_id', $jugadorSaleId);
            })
            ->first();

        if ($existingCambio) {
            return redirect()->back()->with('errorcambio', 'Error: Este cambio ya está registrado para el partido seleccionado.');
        }
        $jugadorcambio = JugadorCambio::create($request->all());
        $jugadorcambio->save();
        return redirect()->route('cambios.index')->with('create', 'Cambio registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $jugadorcambio = JugadorCambio::find($id);
        $partidos = Partido::all();
        $jugadores = Jugador::all();
        return view('gestionpartidos.cambios.show', compact('jugadorcambio', 'partidos', 'jugadores'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $jugadorcambio = JugadorCambio::findOrFail($id);
        $partidos = Partido::where('estado', '=', '0')->get();
        $jugadores = Jugador::all();
        return view('gestionpartidos.cambios.edit', compact('jugadorcambio', 'partidos', 'jugadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'partidos_id' => 'required',
            'jugador_entra_id' => 'required',
            'jugador_sale_id' => 'required',
            'minuto_cambio' => 'required|numeric',
            'observacion_cambio' => 'nullable|string',
        ]);
    
        $partidoId = $request->input('partidos_id');
        $jugadorEntraId = $request->input('jugador_entra_id');
        $jugadorSaleId = $request->input('jugador_sale_id');
    
        // Verificar si ya existe un registro con los mismos jugadores en el mismo partido
        $existingCambio = JugadorCambio::where('partidos_id', $partidoId)
            ->where(function ($query) use ($jugadorEntraId, $jugadorSaleId, $id) {
                $query->where('jugador_entra_id', $jugadorEntraId)
                    ->orWhere('jugador_sale_id', $jugadorSaleId);
            })
            ->where('id', '!=', $id) // Excluir el propio registro actual al hacer la verificación
            ->first();
    
        if ($existingCambio) {
            return redirect()->back()->with('errorcambio', 'Error: Este cambio ya está registrado para el partido seleccionado.');
        }
    
        // Actualizar el cambio
        $jugadorcambio = JugadorCambio::findOrFail($id);
        $jugadorcambio->update($request->all());

        return redirect()->route('cambios.index')->with('update', 'Cambio actualizado correctamente');


        



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JugadorCambio $jugadorCambio)
    {
        //
    }

    public function obtenerJugadoresPorPartido($partidoId, $equipo)
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

    public function generarInformePDF()
{   
    $jugadorcambios = JugadorCambio::with(['partido', 'jugadorEntra', 'jugadorSale'])    
    ->orderBy('id', 'desc')->get();
    $data = [
        'jugadorcambios' => $jugadorcambios,
    ];

    $pdf = PDF::loadView('pdf.jugadorcambios_reporte', $data);

    return $pdf->download('jugadorcambios_reporte.pdf');
}

    

}
