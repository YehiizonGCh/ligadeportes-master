<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Str;
use PDF;

class EntrenadorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-entrenador|crear-entrenador|editar-entrenador|borrar-entrenador')->only('index');
        $this->middleware('permission:crear-entrenador', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-entrenador', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-entrenador', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        //paginacion y busqueda

        $texto= trim($request->get('texto'));
        $entrenadores=Entrenador::withCount('equipos')
            ->where('nombre','LIKE','%'.$texto.'%')
            ->orWhere('apellido_paterno','LIKE','%'.$texto.'%')
            ->orWhere('apellido_materno','LIKE','%'.$texto.'%')
            ->orWhere('dni','LIKE','%'.$texto.'%')
            ->orderBy('id','desc')
            ->paginate(4);
        return view('entrenadores.index', compact('entrenadores','texto'));
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('entrenadores.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate ($request,[
            'dni' => 'required|numeric|digits:8|unique:entrenadors,dni',
            'nombre' => 'required|string|max:50|unique:entrenadors,nombre|min:3',
            'apellido_materno' => 'required|string|max:50|min:3',
            'apellido_paterno' => 'required|string|max:50|min:3',
            'direccion' => 'required|string|max:100|min:3',
            'firma' => 'required|image|mimes:jpeg,png,jpg|max:2048',


            
        ]);
        $data = $request->all();
        if($request->has('firma')){
            $imagenes=$request->file('firma')->store('public/entrenadorfirma');
            $url=Storage::url($imagenes);
            $data['firma']=$url;

        }
        if($request->has('foto')){
            $imagenes=$request->file('foto')->store('public/entrenadorfoto');
            $url=Storage::url($imagenes);
            $data['foto']=$url;

        }
        Entrenador::create($data);
        return redirect()->route('entrenadores.index')->with('create','El entrenador se creo con exito');
        
        


    }

    /**
     * Display the specified resource.
     */
    public function show(Entrenador $entrenador)
    {
        return view('entrenadores.modal.show', compact('entrenador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $entrenador = Entrenador::findOrFail($id);
        return view('entrenadores.edit', compact('entrenador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $entrenador = Entrenador::findOrFail($id);

        $this->validate($request, [
            'dni' => 'numeric|digits:8|unique:entrenadors,dni,' . $entrenador->id,
            'nombre' => 'string|max:50|min:3|unique:entrenadors,nombre,' . $entrenador->id,
            'apellido_materno' => 'required|string|max:50|min:3',
            'apellido_paterno' => 'required|string|max:50|min:3',
            'direccion' => 'required|string|max:100|min:3',
            'firma' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $data = $request->all();
        $imagenanterior=$entrenador->firma;
        if($request->has('firma')){
            if (!empty ($imagenanterior)) {
                Storage::delete($imagenanterior);
            }
            $imagenes=$request->file('firma')->store('public/entrenadorfirma');
            $url=Storage::url($imagenes);
            $data['firma']=$url;
            if($entrenador->firma){
                $imagenanterior=$entrenador->firma;
                $rutadelaimagen=Str::replace('storage', 'public', $imagenanterior);
                Storage::delete($rutadelaimagen);
            }

        }
        $imagenanteriores=$entrenador->foto;
        if($request->has('foto')){
            if (!empty ($imagenanteriores)) {
                Storage::delete($imagenanteriores);
            }
            $imagenes=$request->file('foto')->store('public/entrenadorfoto');
            $url=Storage::url($imagenes);
            $data['foto']=$url;
            if($entrenador->foto){
                $imagenanteriores = $entrenador->foto;
                $rutadelaimagen = Str::replace('storage', 'public', $imagenanteriores);
                Storage::delete($rutadelaimagen);

            }
        }
        $entrenador->update($data);        
       

        return redirect()->route('entrenadores.index')->with('update','El entrenador se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $entrenador=Entrenador::find($id);
        if ($entrenador->estado == 1) {
            DB::table('entrenadors')->where('id', $id)->update(['estado' => 0]);
            return redirect()->route('entrenadores.index');
        }
        DB::table('entrenadors')->where('id', $id)->update(['estado' => 1]);
        return redirect()->route('entrenadores.index');
        
    }


        // funcion para mostrar el estado del entrenador en la vista como finzalizado despues de aver culminado la fecha de fin
        public function generarInformePDF()
    {  
        $entrenadores = Entrenador::withCount('equipos') 
        ->orderBy('id', 'asc')->get();
        $data = [
            'entrenadores' => $entrenadores,
        ];

    
    
        $pdf = PDF::loadView('pdf.entrenadores_reporte', $data);
    
        return $pdf->download('entrenadores_reporte.pdf');
    } 
       
}
