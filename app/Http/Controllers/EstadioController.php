<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Estadio;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EstadioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-estadio|crear-estadio|editar-estadio|borrar-estadio')->only('index');
        $this->middleware('permission:crear-estadio', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-estadio', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-estadio', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

            //
            $texto= trim($request->get('texto'));
            $estadios=Estadio::where('nombre','LIKE','%'.$texto.'%')
                ->orderBy('id','desc')
                ->paginate(4);
            return view('inscripciones.estadios.index', compact('estadios','texto'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estadio=new Estadio();
        // relacion con estadioes
        $clubs=Club::all();
        return view('inscripciones.estadios.create',compact('estadio','clubs'));


    }


    public function store(Request $request)
    {

        $this->validate ($request,[
            'nombre' => 'required|string|max:50|unique:estadios,nombre|min:3',
            'direccion' => 'required',
            'departamento' => 'required',
            'clubs_id' => 'required|unique:estadios',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $data = $request->all();
        if($request->has('imagen')){
            $imagenes=$request->file('imagen')->store('public/estadio');
            $url=Storage::url($imagenes);
            $data['imagen']=$url;

        }
        Estadio::create($data);
        return redirect()->route('estadios.index')->with('create','El estadio se creo con exito');


        
    }

    /**
     * Display the specified resource.
     */
    public function show(Estadio $estadio, Club $club)
    {

        $estadios = $estadio->estadios;
        $clubs = $club->clubs;

        return view('inscripciones.estadios.show', compact('clubs','estadios'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estadio $estadio)
    {

        $estadio = Estadio::find($estadio->id);
        $clubs = Club::all();

        return view('inscripciones.estadios.edit', compact('estadio', 'clubs'));

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate ($request,[
            'nombre' => 'required|string|max:50',
            'direccion' => 'required',
            'departamento' => 'required',
            'clubs_id' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $estadio = Estadio::findOrFail($id);
        $data = $request->all();
        $imagenanterior = $estadio->imagen;

        if($request->has('imagen')){
            Storage::delete($imagenanterior);
            $imagenes=$request->file('imagen')->store('public/estadio');
            $url=Storage::url($imagenes);
            $data['imagen']=$url;
            if($estadio->imagen){
                $imagenanterior = $estadio->imagen;
                $rutadelaimagen = Str::replace('storage', 'public', $imagenanterior);
                Storage::delete($rutadelaimagen);

            }
        }

        $estadio->update($data);

        return redirect()->route('estadios.index')->with('update','El estadio se actualizo con exito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

         $estadio=Estadio::find($id);
         if ($estadio->estado == 1) {
             DB::table('estadios')->where('id', $id)->update(['estado' => 0]);
             return redirect()->route('estadios.index');
         }
         DB::table('estadios')->where('id', $id)->update(['estado' => 1]);
         return redirect()->route('estadios.index');

    }
}
