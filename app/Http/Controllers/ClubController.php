<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Club;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
class ClubController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-club|crear-club|editar-club|borrar-club')->only('index');
        $this->middleware('permission:crear-club', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-club', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-club', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $clubs = Club::all();
        // return view('inscripciones.clubs.index', compact('clubs'));
        $texto= trim(request()->get('texto'));  
        $clubs = Club::where('nombre','LIKE','%'.$texto.'%')
        ->orWhere('temporada','LIKE','%'.$texto.'%')
        ->orWhere('representante','LIKE','%'.$texto.'%')
        ->orWhere('dni_representante','LIKE','%'.$texto.'%')
        ->orderBy('id','desc')
        ->paginate(6);
        return view('inscripciones.clubs.index', compact('clubs','texto'));

        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //categorys
        $categorias = Category::pluck('nombre', 'id');
        return view('inscripciones.clubs.create',['categorias'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
       
        $this->validate ($request,[
            'nombre' => 'required|string|max:50|min:3|unique:clubs,nombre',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'temporada' => 'required',  
            'representante' => 'required',
            'dni_representante' => 'required|numeric|digits:8|unique:clubs,dni_representante',
            'categorias' => 'required',
        ]);
        $data = $request->all();
        if($request->has('logo')){
            $imagenes=$request->file('logo')->store('public/club');
            $url=Storage::url($imagenes);
            $data['logo']=$url;

        }

        $club = Club::create($data);
        $club->categorys()->sync($request->categorias);

        return redirect()->route('clubs.index')->with('create','El club se creo con exito');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        //
        $club = Club::find($club->id);
       //categorias
        $categorias = Category::pluck('nombre', 'id');
        return view('inscripciones.clubs.show', compact('club','categorias'));

    }

    /**
     * Show the form for editing the specified resource.
     */

     //modifiqueaqui
    public function edit(Club $club ,Category $categorias)
    {
  
        // editar club y las categorias
        $club = Club::find($club->id);
        $categorias = Category::pluck('nombre', 'id');
        return view('inscripciones.clubs.edit', compact('club','categorias'));
        

     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $club )
    {
        //

        
        $this->validate ($request,[
            'nombre' => 'required|string|max:50',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'temporada' => 'required',  
            'representante' => 'required',
            'dni_representante' => 'required|numeric|digits:8|unique:clubs,dni_representante,' .$club->id,
           'categorias' => 'required',

        ]);

       
        $club = Club::find($club->id);
        $data = $request->all();
        $imagenanterior = $club->logo;
        
        if($request->has('logo')){
            Storage::delete($imagenanterior);
            $imagenes=$request->file('logo')->store('public/club');
            $url=Storage::url($imagenes);
            $data['logo']=$url;
            if($club->logo){
                $imagenanterior = $club->logo;
                $rutadelaimagen = Str::replace('storage', 'public', $imagenanterior);
                Storage::delete($rutadelaimagen);

            }
        }
        
        $club->update($data);
        $club->categorys()->sync($request->categorias);

        return redirect()->route('clubs.index')->with('update','El club se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $club = Club::find($id);    
        if($club->estado == 1){

            DB::table('clubs')->where('id', $id)->update(['estado' => 0]);
            return redirect()->route('clubs.index');
        }
        //
        DB::table('clubs')->where('id', $id)->update(['estado' => 1]);
        return redirect()->route('clubs.index');
}


public function generarInformePDF()

{  
    
    $clubs = Club::withCount('categorys')
    ->orderBy('id','desc')
    ->get();
    $data = [
        'title' => 'Listado de clubs',
        'date' => date('d-m-Y'),
        'clubs' => $clubs
    ];
    
    $pdf = PDF::loadView('pdf.clubs_reporte', $data);
   

    return $pdf->download('clubs_reporte.pdf');
} 
}
