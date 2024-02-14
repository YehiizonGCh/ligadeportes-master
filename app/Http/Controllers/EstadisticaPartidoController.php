<?php

namespace App\Http\Controllers;

use App\Models\EstadisticaPartido;
use App\Models\Partido;
use Illuminate\Http\Request;
use PDF;


class EstadisticaPartidoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-estadistica-partido|crear-estadistica-partido|editar-estadistica-partido|borrar-estadistica-partido')->only('index');
        $this->middleware('permission:crear-estadistica-partido', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-estadistica-partido', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-estadistica-partido', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $texto = trim($request->get('texto'));
    $estadisticapartidos=EstadisticaPartido::with('partido')
    ->whereHas('partido', function ($q) use ($texto) {
        $q->where('fecha_partido', 'LIKE', '%' . $texto . '%');

    })
    ->orWhereHas('partido.equipolocal.club', function ($q) use ($texto) {
        $q->where('nombre', 'LIKE', '%' . $texto . '%');
    })
    ->orWhereHas('partido.equipovisitante.club', function ($q) use ($texto) {
        $q->where('nombre', 'LIKE', '%' . $texto . '%');
    })
    // categorias
    ->orWhereHas('partido.equipolocal.categoria', function ($q) use ($texto) {
        $q->where('nombre', 'LIKE', '%' . $texto . '%');
    })
    

     ->orderBy('id', 'desc')->paginate(5);

    
    

    return view('gestionpartidos.resultados.index', compact('estadisticapartidos', 'texto'));
}

    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partidos = Partido::where('estado', '=', '1')->get();

        return view('gestionpartidos.resultados.create', compact('partidos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'goles_visitante' => 'required|numeric',
            'goles_local' => 'required|numeric',
            'partidos_id' => 'required',
            'corners_visitante' => 'required|numeric',
            'corners_local' => 'required|numeric',
            'faltas_visitante' => 'required|numeric',
            'faltas_local' => 'required|numeric',
            'tarjetas_amarillas_visitante' => 'required|numeric',
            'tarjetas_amarillas_local' => 'required|numeric',
            'tarjetas_rojas_visitante' => 'required|numeric',
            'tarjetas_rojas_local' => 'required|numeric',


        ]);
        // Cambiar el estado del partido a 0 al registrar el resultado
        $partido = Partido::find($request->partidos_id);
        $partido->estado = 0;
        $partido->save();

        $estadisticapartido=EstadisticaPartido::create($request->all());
        $estadisticapartido->save();


        
        
        return redirect()->route('resultados.index')->with('create', 'Resultado registrado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)

    {
        //
        $estadisticapartido = EstadisticaPartido::find($id);
       return view('gestionpartidos.resultados.show', compact('estadisticapartido'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $estadisticapartido = EstadisticaPartido::findOrfail($id);
       $partidoId = $estadisticapartido->partidos_id;

       // Obtén solo el partido asociado al id obtenido
       $partidos = Partido::where('id', $partidoId)->get();
        return view('gestionpartidos.resultados.edit', compact( 'estadisticapartido', 'partidos'));
       

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id )
    {
        //
       // $estadisticapartido = EstadisticaPartido::findOrfail($estadisticapartido->id);
        $this->validate($request, [
            'goles_visitante' => 'required|numeric',
            'goles_local' => 'required|numeric',
            'partidos_id' => 'required',
            'corners_visitante' => 'required|numeric',
            'corners_local' => 'required|numeric',
            'faltas_visitante' => 'required|numeric',
            'faltas_local' => 'required|numeric',
            'tarjetas_amarillas_visitante' => 'required|numeric',
            'tarjetas_amarillas_local' => 'required|numeric',
            'tarjetas_rojas_visitante' => 'required|numeric',
            'tarjetas_rojas_local' => 'required|numeric',
        ]);
        $estadisticapartido = EstadisticaPartido::findOrfail($id);
        $estadisticapartido->update($request->all());
        return redirect()->route('resultados.index')->with('update', 'Resultado actualizado con exito');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadisticaPartido $estadisticaPartido)
    {
        //
    }

    public function generarInformePDF()
{   
    $estadisticapartidos = EstadisticaPartido::all();
    $data = [
        'title' => 'Listado de partidos',
        'estadisticapartidos' => $estadisticapartidos,
    ];


    $pdf = PDF::loadView('pdf.partidosresultados_reporte', $data);

    return $pdf->download('resultados_reporte.pdf');
}
}
