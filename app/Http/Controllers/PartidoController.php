<?php

namespace App\Http\Controllers;

use App\Models\JugadorEncuentro;
use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Estadio;
use App\Models\Arbitro;
use App\Models\Category;
use App\Models\JugadorCambio;
use App\Models\Liga;
use Illuminate\Support\Facades\DB;
use App\Models\Torneo;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;


class PartidoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-partido|crear-partido|editar-partido|borrar-partido')->only('index');
        $this->middleware('permission:crear-partido', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-partido', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-partido', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $equipo_local = $request->get('equipo_local');
        $equipo_visitante = $request->get('equipo_visitante');
        $fecha_inicial = $request->get('fecha_inicial');
        $fecha_final = $request->get('fecha_final');
    
        $query = Partido::with('equipolocal', 'equipovisitante', 'arbitros', 'estadio')
            ->orderBy('id', 'desc');
    
        // Filtrar por nombre de equipo local
        if ($equipo_local) {
            $query->whereHas('equipolocal', function ($q) use ($equipo_local) {
                $q->where('nombre', 'LIKE', '%' . $equipo_local . '%');
            });
        }
    
        // Filtrar por nombre de equipo visitante
        if ($equipo_visitante) {
            $query->whereHas('equipovisitante', function ($q) use ($equipo_visitante) {
                $q->where('nombre', 'LIKE', '%' . $equipo_visitante . '%');
            });
        }
    
        // Agregar las condiciones de fecha si se proporcionan
        if ($fecha_inicial && $fecha_final) {
            $query->whereBetween('fecha_partido', [$fecha_inicial, $fecha_final]);
        }
    
        // Aplicar la búsqueda general
        if ($texto) {
            $query->where(function ($q) use ($texto) {
                $q->whereHas('equipolocal.club', function ($q) use ($texto) {
                    $q->where('nombre', 'LIKE', '%' . $texto . '%');
                })
                ->orWhereHas('equipovisitante.club', function ($q) use ($texto) {
                    $q->where('nombre', 'LIKE', '%' . $texto . '%');
                })
                ->orWhere('fecha_partido', 'LIKE', '%' . $texto . '%');
            });
            
        }
    
        $partidos = $query->paginate(4);
    
        return view('gestionpartidos.partidos.index', compact('partidos', 'texto', 'equipo_local', 'equipo_visitante', 'fecha_inicial', 'fecha_final'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $partido = new Partido();
        $equipos = Equipo::with('categoria')->get();
        $estadios = Estadio::all();
        $arbitros = Arbitro::all();
        $categorias = Category::with('equipos')->get();
        $ligas=Liga::all();
        return view('gestionpartidos.partidos.create',compact('partido','equipos','estadios','arbitros','categorias','ligas'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //personalizar mensajes

        $messages = [
            'equipos_id.required' => 'El equipo local es obligatorio',
            'equipos_id1.required' => 'El equipo visitante es obligatorio',
            'equipos_id1.different' => 'El equipo visitante debe ser diferente al equipo local',

        ];         
        $this->validate($request, [
            'fecha_partido' => 'required',
            'hora_partido' => 'required',
            'lugar' => 'required',
            'equipos_id' => 'required',
            'equipos_id1' => 'required|different:equipos_id',
            'estadios_id' => 'required',
            'arbitros_id' => 'required',
            'categorys_id' => 'required',
            'ligas_id' => 'required',

        ],$messages);
        Partido::create($request->all());
        return redirect()->route('partidos.index')->with('create','El partido se creo con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partido $partido)
    {
        //
        $jugadoresEncuentros = JugadorEncuentro::with('jugador','partido')->get();
        $jugadorcambio = JugadorCambio::with('jugadorEntra','jugadorSale','partido')->orderBy('minuto_cambio','asc')->get();
        
        $equipos = Equipo::with('categoria')->get();
        $estadios = Estadio::all();
        $arbitros = Arbitro::all();
        $categorias = Category::with('equipos')->get();
        $ligas=Liga::all();

        $jugadoresTitularesLocal = $jugadoresEncuentros->where('titular', 1)
        ->where('jugador.equipos_id', $partido->equipos_id)
        ->pluck('jugador');

    $jugadoresTitularesVisitante = $jugadoresEncuentros->where('titular', 1)
        ->where('jugador.equipos_id', $partido->equipos_id1)
        ->pluck('jugador');

    $jugadoresSuplentesLocal = $jugadoresEncuentros->where('titular', 0)
        ->where('jugador.equipos_id', $partido->equipos_id)
        ->pluck('jugador');

    $jugadoresSuplentesVisitante = $jugadoresEncuentros->where('titular', 0)
        ->where('jugador.equipos_id', $partido->equipos_id1)
        ->pluck('jugador');

    $cambios = $jugadorcambio->where('partidos_id', $partido->id);
    
        

        return view('gestionpartidos.partidos.show',compact('partido','equipos','estadios','arbitros','categorias','ligas','jugadoresTitularesLocal','jugadoresTitularesVisitante','jugadoresSuplentesLocal','jugadoresSuplentesVisitante','cambios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $partido = Partido::find($id);
        $equipos = Equipo::with('categoria')->get();
        $estadios = Estadio::all();
        $arbitros = Arbitro::all();
        $categorias = Category::with('equipos')->get();
        $ligas=Liga::all();
        return view('gestionpartidos.partidos.edit',compact('partido','equipos','estadios','arbitros','categorias','ligas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $messages = [
            'equipos_id.required' => 'El equipo local es obligatorio',
            'equipos_id1.required' => 'El equipo visitante es obligatorio',
            'equipos_id1.different' => 'El equipo visitante debe ser diferente al equipo local',

        ];
        $this->validate($request, [
            'fecha_partido' => 'required',
            'hora_partido' => 'required',
            'lugar' => 'required',
            'equipos_id' => 'required',
            'equipos_id1' => 'required|different:equipos_id',
            'estadios_id' => 'required',
            'arbitros_id' => 'required',
            'categorys_id' => 'required',
            'ligas_id' => 'required',
        ],$messages);
        $partido = Partido::find($id); 
        $partido->update($request->all());
        return redirect()->route('partidos.index')->with('update','El partido se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        /*
          $jugador = Jugador::find($id);
        if ($jugador->estado == 1) {
            DB::table('jugadors')->where('id', $id)->update(['estado' => 0]);
            return redirect()->route('jugadores.index');
        }
        DB::table('jugadors')->where('id', $id)->update(['estado' => 1]);
        return redirect()->route('jugadores.index');
        */
        $partido = Partido::find($id);
        if ($partido->estado == 1) {
           DB::table('partidos')->where('id', $id)->update(['estado' => 0]);
            return redirect()->route('partidos.index');
        }
        DB::table('partidos')->where('id', $id)->update(['estado' => 1]);
        return redirect()->route('partidos.index');
    }

    public function obtenerEquipos($categoryId)
    {
        $equipos = Equipo::where('categorys_id', $categoryId)->get();
        return response()->json($equipos);
    }

    public function generarInformePDF()
    {   
        $partidos = Partido::with('equipolocal', 'equipovisitante', 'arbitros', 'estadio')
        ->orderBy('id', 'asc')->get();
        $data = [
            'partidos' => $partidos,
        ];

    
    
        $pdf = PDF::loadView('pdf.partidos_reporte', $data);
    
        return $pdf->download('partidos_reporte.pdf');
    }


    public function eventos()
    {
        $partidos = Partido::all();

        $eventos = [];

        foreach ($partidos as $partido) {
            $eventos[] = [
                'title' => $partido->equipolocal->nombre . ' vs. ' . $partido->equipovisitante->nombre,
                'start' => $partido->fecha_partido . ' ' . $partido->hora_partido,
                // Puedes agregar más propiedades según tus necesidades
            ];
        }

        return response()->json($eventos);
    }


  

}
