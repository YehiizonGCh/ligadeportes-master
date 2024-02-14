<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Liga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Str;

class TorneoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-torneo|crear-torneo|editar-torneo|borrar-torneo')->only('index');
        $this->middleware('permission:crear-torneo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-torneo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-torneo', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $torneos=Torneo::all();
        foreach ($torneos as $torneo) {
            if ($torneo->fecha_fin < date('Y-m-d')) {
                DB::table('torneos')->where('id', $torneo->id)->update(['estado' => 0]);
            }
        }
        //paginacion y busqueda

        $texto= trim($request->get('texto'));
        $torneos=Torneo::where('nombre','LIKE','%'.$texto.'%')
            ->orWhere('temporada','LIKE','%'.$texto.'%')
            ->orWhere('fecha_inicio','LIKE','%'.$texto.'%')
            ->orderBy('id','desc')
            ->paginate(3);
        return view('eventos.torneos.index', compact('torneos','texto'));
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $torneo=new Torneo();
        // relacion con Torneo
        $ligas=Liga::all();
        return view('eventos.torneos.create')->with(compact('torneo','ligas'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate ($request,[
            'nombre' => 'required|string|max:50|unique:torneos,nombre|min:3',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'temporada' => 'required|string|max:10',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required|after:fecha_inicio',
            'ligas_id' => 'required',
        ]);
        $data = $request->all();
        if($request->has('logo')){
            $imagenes=$request->file('logo')->store('public/torneo');
            $url=Storage::url($imagenes);
            $data['logo']=$url;

        }
        Torneo::create($data);
        return redirect()->route('torneos.index')->with('create','El torneo se creo con exito');
        
        


    }

    /**
     * Display the specified resource.
     */
    public function show(Torneo $torneo)
    {
        $torneo = Torneo::with('categorias')->findOrfail($torneo->id);
        $ligas=Liga::all();
        
        return view('eventos.torneos.show', compact('torneo','ligas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Torneo $torneo)
    {
        //
        $torneo = Torneo::find($torneo->id);
        $ligas=Liga::all();
        return view('eventos.torneos.edit', compact('torneo','ligas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Torneo $torneo)
    {
        //
        $this->validate ($request,[
            'nombre' => 'required|string|max:50|min:3',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'temporada' => 'required|string|max:10',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required|after:fecha_inicio',
            'ligas_id' => 'required',
        ]);
        $torneo=Torneo::find($torneo->id);
        $data = $request->all();
        $imagenanterior=$torneo->logo;
        if($request->has('logo')){
            Storage::delete($imagenanterior);
            $imagenes=$request->file('logo')->store('public/torneo');
            $url=Storage::url($imagenes);
            $data['logo']=$url;
            if($torneo->logo){
                $imagenanterior=$torneo->logo;
                $rutadelaimagen=Str::replace('storage', 'public', $imagenanterior);
                Storage::delete($rutadelaimagen);
            }

        }
        $torneo->update($data);
        return redirect()->route('torneos.index')->with('update','El torneo se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $torneo=Torneo::find($id);
        if ($torneo->estado == 1) {
            DB::table('torneos')->where('id', $id)->update(['estado' => 0]);
            return redirect()->route('torneos.index');
        }
        DB::table('torneos')->where('id', $id)->update(['estado' => 1]);
        return redirect()->route('torneos.index');
        
    }


        // funcion para mostrar el estado del torneo en la vista como finzalizado despues de aver culminado la fecha de fin
        
       
}
