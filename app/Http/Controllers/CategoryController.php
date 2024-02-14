<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-categoria|crear-categoria|editar-categoria|borrar-categoria')->only('index');
        $this->middleware('permission:crear-categoria', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-categoria', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-categoria', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)

    {
        //paginacion y busqueda
        
        $texto= trim($request->get('texto'));
        $categorias=Category::withCount('clubs','torneos')
            ->where('nombre','LIKE','%'.$texto.'%')
            ->orWhere('abreviatura','LIKE','%'.$texto.'%')
            ->orWhereHas('torneos', function ($query) use ($texto) {
                $query->where('nombre', 'like', '%'.$texto.'%');
            })
            ->orderBy('id','desc')
            ->paginate(6);
        


        
        return view('inscripciones.categorias.index', compact('categorias','texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //torneos
        $categoria=new Category();
        $torneos=Torneo::where('estado',1)->get();
        return view('inscripciones.categorias.create',compact('categoria','torneos'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       
        $this->validate ($request,[
            'nombre' => 'required|string|max:50|unique:categorys|min:3',
            'edad_minima' => 'required',
            'edad_maxima' => 'required|gt:edad_minima',
            'sexo' => 'required|string|max:10',
            'torneos_id' => 'required',
        ]);
        Category::create($request->all());
        
        return redirect()->route('categorias.index')->with('create','La categoria se creo con exito');
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $categoria)
    {
        $equipos = $categoria->equipos;
        return view('inscripciones.categorias.show', compact('categoria','equipos'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categoria)
    {
        //editar categoria
        $categoria = Category::find($categoria->id);
        $torneos=Torneo::where('estado',1)->get();
        
        return view('inscripciones.categorias.edit', compact('categoria','torneos'));

        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $categoria )
    {
       
         
        $this->validate ($request,[
            'nombre' => 'required|string|max:50',
            'edad_minima' => 'required',
            'edad_maxima' => 'required|gt:edad_minima',
            'sexo' => 'required|string|max:10',
            'torneos_id' => 'required',
        ]);

        $registro=Category::find($categoria->id);
        $registro->nombre=$request->input('nombre');
        $registro->abreviatura=$request->input('abreviatura');
        $registro->edad_minima=$request->input('edad_minima');
        $registro->edad_maxima=$request->input('edad_maxima');
        $registro->sexo=$request->input('sexo');
        $registro->torneos_id=$request->input('torneos_id');
        $registro->save();
        

       return redirect()->route('categorias.index')->with('update','La categoria se actualizo con exito');

    }

    /**
     * Remove the specified resource from storage.
     *  
     */
    public function destroy($id  )
    {

        $categoria = Category::find($id);
            if ($categoria->estado == 1) {
                DB::table('categorys')->where('id', $id)->update(['estado' => 0]);
                return redirect()->route('categorias.index');
            }
            DB::table('categorys')->where('id', $id)->update(['estado' => 1]);
            return redirect()->route('categorias.index');


        

    }

    public function generarInformePDF()
    {  
        $categorias = Category::withCount('clubs','torneos')
        ->orderBy('id','desc')
        ->get();
        $data = [
            'categorias' => $categorias,
        ];

    
    
        $pdf = PDF::loadView('pdf.categorias_reporte', $data);
    
        return $pdf->download('categorias_reporte.pdf');
    } 
}
