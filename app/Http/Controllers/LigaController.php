<?php

namespace App\Http\Controllers;

use App\Models\Liga;
use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Str;

class LigaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-liga|crear-liga|editar-liga|borrar-liga')->only('index');
        $this->middleware('permission:crear-liga', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-liga', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-liga', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $texto= trim($request->get('texto'));
            $ligas=Liga::where('nombre','LIKE','%'.$texto.'%')
                ->orderBy('id','desc')
                ->paginate(4);
            return view('eventos.ligas.index', compact('ligas','texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('eventos.ligas.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre'=> 'required|string|max:50|unique:ligas,nombre|min:3',
            'abreviatura'=> 'required',
            'descripcion'=> 'nullable|string|max:350',
            'logo'=> 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $data =$request->all();
        if($request->has('logo')){
            $imagenes=$request->file('logo')->store('public/liga');
            $url=Storage::url($imagenes);
            $data['logo']=$url;

        }
        Liga::create($data);
        return redirect()->route('ligas.index')->with('create','La liga se creo con exito');


    }

    /**
     * Display the specified resource.
     */
    public function show(Liga $liga, Torneo $torneo)
    {
        //
        $ligas = $liga->ligas;
        //$torneos = $torneo->torneos;

        return view('inscipciones.ligas.show', compact('ligas'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liga $liga)
    {

        $liga = Liga::find($liga->id);
        return view('eventos.ligas.edit', compact('liga'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Liga $liga)
    {

        $this->validate ($request,[
            'nombre' => 'required|string|max:50|min:3',
            'abreviatura' => 'required|string|max:10',
            'descripcion' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',

        ]);
        $liga=Liga::find($liga->id);
        $data = $request->all();
        $imagenanterior=$liga->logo;

        if($request->has('logo')){
            Storage::delete($imagenanterior);
            $imagenes=$request->file('logo')->store('public/liga');
            $url=Storage::url($imagenes);
            $data['logo']=$url;
            if($liga->logo){
                $imagenanterior=$liga->logo;
                $rutadelaimagen=Str::replace('storage', 'public', $imagenanterior);
                Storage::delete($rutadelaimagen);
            }

        }
        $liga->update($data);
        return redirect()->route('ligas.index')->with('update','La liga se actualizo con exito');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        //
        $liga=Liga::find($id);
        if ($liga->estado == 1) {
            DB::table('ligas')->where('id', $id)->update(['estado' => 0]);
            return redirect()->route('ligas.index');
        }
        DB::table('ligas')->where('id', $id)->update(['estado' => 1]);
        return redirect()->route('ligas.index');

    }
}
