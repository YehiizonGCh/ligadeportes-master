<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\support\Facades\DB;
use PDF;
class ArbitroController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-arbitro|crear-arbitro|editar-arbitro|borrar-arbitro')->only('index');
        $this->middleware('permission:crear-arbitro', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-arbitro', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-arbitro', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
    
        if ($texto) {
            $arbitros = Arbitro::where('nombre', 'like', '%' . $texto . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $texto . '%')
                ->orWhere('apellido_materno', 'like', '%' . $texto . '%')
                ->orWhere('dni', 'like', '%' . $texto . '%')
                ->orderBy('id', 'desc')
                ->paginate(5);

    
            return view('inscripciones.arbitros.index', compact('arbitros', 'texto'));
        }
    
        // Si no hay texto, obtener todos los árbitros
        $arbitros = Arbitro::orderBy('id', 'desc')->paginate(5);
        return view('inscripciones.arbitros.index', compact('arbitros', 'texto'));
    }
    
      
        
        public function create()
        {
            $arbitro = new Arbitro();
            return view('inscripciones.arbitros.create', compact('arbitro'));
    
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            //
            $this->validate ($request,[
                'nombre' => 'required|regex:/^[\pL\s]+$/u|string|max:60|min:3',
                'apellido_paterno' => 'required|regex:/^[\pL\s]+$/u|string|max:50',
                'apellido_materno' => 'required|regex:/^[\pL\s]+$/u|string|max:50',
                'dni' => 'required|numeric|digits:8|unique:arbitros,dni',
                'edad'=>'required|numeric|min:18|max:100',
                'telefono' => 'required|numeric|digits:9|regex:/^9[0-9]+$/',
                'tipo_arbitro' => 'required',
                'foto'=>'nullable|file|mimes:jpg,jpeg,png',
            ]);
    
           
    
            $arbitro = new Arbitro();
    
            $arbitro->nombre = $request->input('nombre');
            $arbitro->apellido_paterno = $request->input('apellido_paterno');
            $arbitro->apellido_materno = $request->input('apellido_materno');
            $arbitro->dni = $request->input('dni');
            $arbitro->edad = $request->input('edad');
            $arbitro->tipo_arbitro = $request->input('tipo_arbitro');
            $arbitro->telefono = $request->input('telefono');
            $arbitro->estado = true;
    
    
            $arbitro->save();
    
            return redirect()->route('arbitros.index')->with('create', 'El arbitro se creo con exito');
    
    
    
        }
    
        /**
         * Display the specified resource.
         */
        public function show(Arbitro $arbitro)
        {
            //
    
    
            $arbitros = $arbitro->arbitros;
             return view('inscripciones.arbitros.show', compact('arbitros'));
        }
    
        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Arbitro $arbitro)
        {
            //
            $arbitro = Arbitro::find($arbitro->id);
            return view('inscripciones.arbitro.edit', compact('arbitro'));
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, $id)
        {
            //
            $arbitro=Arbitro::findOrFail($id);
            $this->validate ($request,[
                'nombre' => 'required|string|max:50',
                'apellido_paterno' => 'required|string|max:50',
                'apellido_materno' => 'required|string|max:50',
                'dni' => 'required|numeric|digits:8',
                'edad'=>'required|numeric|min:18|max:100',
                'telefono' => 'required|numeric|digits:9',
                'tipo_arbitro' => 'required',
            ]);
    
            
            
            $arbitro->nombre = $request->input('nombre');
            $arbitro->apellido_paterno = $request->input('apellido_paterno');
            $arbitro->apellido_materno = $request->input('apellido_materno');
            $arbitro->dni = $request->input('dni');
            $arbitro->edad = $request->input('edad');
            $arbitro->tipo_arbitro = $request->input('tipo_arbitro');
            $arbitro->telefono = $request->input('telefono');
            $arbitro->estado = true;
    
            $arbitro->save();
            return redirect()->route('arbitros.index')->with('update', 'El arbitro se actualizo con exito');
         }
    
    
        /**
         * Remove the specified resource from storage.
         */
        public function destroy($id)
        {
            //
            $arbitro=Arbitro::find($id);
            if ($arbitro->estado == 1) {
                DB::table('arbitros')->where('id', $id)->update(['estado' => 0]);
                return redirect()->route('arbitros.index');
            }
            DB::table('arbitros')->where('id', $id)->update(['estado' => 1]);
            return redirect()->route('arbitros.index');
        }
    }