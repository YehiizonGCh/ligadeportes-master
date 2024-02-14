<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Category;
use App\Models\Entrenador;
use App\Models\Jugador;
use PDF;

class EquipoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-equipo|crear-equipo|editar-equipo|borrar-equipo')->only('index');
        $this->middleware('permission:crear-equipo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-equipo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-equipo', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        //
        $texto = trim($request->get('texto'));
        $equipos = Equipo::with('club', 'categoria', 'entrenador')
            ->where('nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('representante', 'LIKE', '%' . $texto . '%')
            ->orWhereHas('club', function ($query) use ($texto) {
                $query->where('nombre', 'like', '%' . $texto . '%');
            })
            ->orWhereHas('categoria', function ($query) use ($texto) {
                $query->where('nombre', 'like', '%' . $texto . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(4);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   

        return view('inscripciones.equipos.index', compact('equipos', 'texto'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipo = new Equipo();
        $clubs = Club::with('categorys')->get();
        $categoria = Category::with('torneos')->get();
        $entrenadores = Entrenador::all();
        return view('inscripciones.equipos.create', compact('equipo', 'clubs', 'categoria', 'entrenadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nombre' => 'required|max:50|min:3|unique:equipos,nombre',
            'representante' => 'required',
            'clubs_id' => 'required',
            'categorys_id' => 'required',
            'entrenadors_id' => 'required',
        ]);
        $equipo = Equipo::create($request->all());
        $equipo->save();
        return redirect()->route('equipos.index')->with('create', 'El equipo se creo con exito');



    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        return view('inscripciones.equipos.show', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        //
    
        $equipo = Equipo::with('club', 'categoria', 'entrenador')->findOrfail($equipo->id);
        $clubs = Club::with('categorys')->get();
        $categorias = Category::pluck('nombre', 'id');
        $entrenadores = Entrenador::all();
        
        return view('inscripciones.equipos.edit', compact('equipo', 'clubs', 'categorias', 'entrenadores'));
    }
    public function update(Request $request, Equipo $equipo)
    {
        $this->validate($request, [
            'nombre' => 'required|max:50|min:3',
            'representante' => 'required',
            'clubs_id' => 'required',
            'categorys_id' => 'required',
            'entrenadors_id' => 'required',
        ]);

        $equipo->update($request->all());

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado con éxito');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        //
    }

    public function obtenerCategorias(Club $club)
    {
        $categorias = $club->categorys->pluck('nombre', 'id');

        // $torneos = $club->categorys->map(function ($categoria) {
        //     return $categoria->torneos->nombre;
        // });
        return response()->json(['categorias' => $categorias]);
        // return response()->json(['categorias' => $categorias, 'torneos' => $torneos]);

        // return response()->json($categorias);
        //  return response()->json(['categorias' => $categorias, 'torneos' => $club->categorys->pluck('torneos', 'id')]);



    }

    public function obtenerTorneo(Category $categoria)
    {
        $torneos = $categoria->torneos->pluck('nombre', 'id');


        return response()->json(['torneos' => $torneos->nombre]);


        // Accede a la relación "torneo" de la categoría

        // return response()->json(['torneos' => $torneos->nombre]);

    }

    public function generarInformePDF()
    {  
        $equipos = Equipo::with(['club', 'categoria', 'entrenador'])
        ->orderBy('id', 'desc')->get(); 
        $data = [
            'equipos' => $equipos
        ];
    
        $pdf = PDF::loadView('pdf.equipos_reporte', $data);
    
        return $pdf->download('Equipos_reporte.pdf');
    }
}
