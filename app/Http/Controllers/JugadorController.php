<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Mail\jugadornuevo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Attachment;
use PDF;
use Dompdf\Dompdf;
class JugadorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-jugador|crear-jugador|editar-jugador|borrar-jugador')->only('index');
        $this->middleware('permission:crear-jugador', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-jugador', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-jugador', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        //trae los clubes y pagination(5) y buesqueda por nombre
        $texto= trim($request->get('texto'));
        $jugadores=Jugador::with('equipos')
            ->where('nombres','LIKE','%'.$texto.'%')
            ->orWhere('apellido_paterno','LIKE','%'.$texto.'%')
            ->orWhere('apellido_materno','LIKE','%'.$texto.'%')
            ->orWhere('dni','LIKE','%'.$texto.'%')
            ->orWhere('posicion','LIKE','%'.$texto.'%')
            ->orWhereHas('equipos',function($query) use ($texto){
                $query->where('nombre','like','%'.$texto.'%');
            })

            ->orderBy('id','desc')
            ->paginate(3);

        return view('inscripciones.jugadores.index', compact('jugadores','texto'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jugador = new Jugador();
        $equipos = Equipo::all();
        
        return view('inscripciones.jugadores.create', compact('jugador', 'equipos'));
    }
    
    public function store(Request $request)
    {
        $msg= $this->validate($request, [
            'apellido_materno' => 'required|max:50|min:3',
            'apellido_paterno' => 'required|max:50|min:3',
            'nombres' => 'required|max:50|min:3',
            'dni' => 'required|numeric|digits:8|unique:jugadors,dni',
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'estado_civil' => 'required',
            'trabaja' => 'required',
            'estudia' => 'required',
            'talla' => 'numeric|max:2.5',
            'peso' => 'numeric|max:100',
            'domicilio' => 'required',
            'nombre_padre' => 'required',
            'nombre_madre' => 'required',
            'fecha_nacimiento' => 'required|date',
            'posicion' => 'required',
            'dorsal' => 'nullable|numeric',
            'documentos' => 'nullable|file|mimes:pdf,doc,docx',
            'ficha_medica'=> 'nullable|file|mimes:pdf,doc,docx',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png',
            'club_origen' => 'required',
            'equipos_id' => 'required',
            

        ]);
        $documentos = $request->file('documentos');
        $fichaMedica = $request->file('ficha_medica');
        Mail::to('barrett@example.com')->send(new jugadornuevo($msg,$documentos,$fichaMedica));
       /* ->attach($request->file('documentos'))*/

        $fechaNacimiento = new \DateTime($request->input('fecha_nacimiento'));
        $hoy = new \DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;
        $jugador = new Jugador();
      
        // archivos documentos
            if ($request->hasFile('documentos')) {
            $file = $request->file('documentos');
            $fileName ='Autorizacion-'. $request->input('nombres') . '-' . $request->input('apellido_paterno') . '-'. $request->input('dni') . '.' . $file->getClientOriginalExtension();
            $docs = $file->storeAs('public/jugadores/documentos', $fileName);
            $url = Storage::url($docs);
            $jugador->documentos = $url;
        }
        
        // archivos ficha medica
        if ($request->hasFile('ficha_medica')) {
            $file = $request->file('ficha_medica');
            $fileName = 'FichaMedica-' . $request->input('nombres') . '-' . $request->input('apellido_paterno') . '-' . $request->input('dni') . '.' . $file->getClientOriginalExtension();
            $ficha = $file->storeAs('public/jugadores/ficha_medica', $fileName);
            $url = Storage::url($ficha);
            $jugador->ficha_medica = $url;
        }
        // archivos foto
        if($request->has('foto')){
            $imagenes=$request->file('foto')->store('public/jugadores/foto');
            $url=Storage::url($imagenes);
            $jugador->foto=$url;            
        }
        
        $jugador->apellido_paterno = $request->input('apellido_paterno');
        $jugador->apellido_materno = $request->input('apellido_materno');       
        $jugador->nombres = $request->input('nombres');
        $jugador->dni = $request->input('dni');
        $jugador->departamento = $request->input('departamento');
        $jugador->provincia = $request->input('provincia');
        $jugador->distrito = $request->input('distrito');
        $jugador->estado_civil = $request->input('estado_civil');
        $jugador->trabaja = $request->input('trabaja');
        $jugador->estudia = $request->input('estudia');
        $jugador->talla = $request->input('talla');
        $jugador->peso = $request->input('peso');
        $jugador->domicilio = $request->input('domicilio');
        $jugador->nombre_padre = $request->input('nombre_padre');
        $jugador->nombre_madre = $request->input('nombre_madre');
        $jugador->grupo_sanguineo = $request->input('grupo_sanguineo');
        $jugador->fecha_nacimiento = $request->input('fecha_nacimiento');
        $jugador->edad = $edad;
        $jugador->posicion = $request->input('posicion');
        $jugador->dorsal = $request->input('dorsal');
        $jugador->club_origen = $request->input('club_origen');
        $jugador->equipos_id = $request->input('equipos_id');
        $jugador->estado = true;
    
        $equipo = Equipo::with('categoria')->find($jugador->equipos_id);
    
      
    
        if($edad < $equipo->categoria->edad_minima || $edad > $equipo->categoria->edad_maxima) {
            return redirect()->back()->with('error', 'El jugador no cumple con los requisitos de edad para este equipo.');
        }
        $jugador->save();
    
        return redirect()->route('jugadores.index')->with('create', 'El jugador se creó con éxito');
    }
    
    
    
    /**
     * Display the specified resource.
     *
     */
    public function show(Jugador $jugador,$id)
    {
        $jugador = Jugador::with('equipos')->findOrfail($id);
        $equipos = Equipo::all();

        return view('inscripciones.jugadores.show', compact('jugador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     */
    public function edit($id)
    {
        $jugador = Jugador::with('equipos')->findOrfail($id);
        $equipos = Equipo::all();
        return view('inscripciones.jugadores.edit', compact('jugador', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $jugador = Jugador::with('equipos')->findOrfail($id);
        $this->validate($request, [
            'apellido_materno' => 'required|max:50|min:3',
            'apellido_paterno' => 'required|max:50|min:3',
            'nombres' => 'required|max:50|min:3',
            'dni' => 'required|numeric|digits:8|unique:jugadors,dni,'.$jugador->id,
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'estado_civil' => 'required',
            'trabaja' => 'required',
            'estudia' => 'required',
            'talla' => 'numeric|max:2.5',
            'peso' => 'numeric|max:100',
            'domicilio' => 'required',
            'nombre_padre' => 'required',
            'nombre_madre' => 'required',
            'fecha_nacimiento' => 'required|date',
            'posicion' => 'required',
            'dorsal' => 'nullable|numeric',
            'documentos' => 'nullable|file|mimes:pdf,doc,docx',
            'ficha_medica'=> 'nullable|file|mimes:pdf,doc,docx',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png',
            'club_origen' => 'required',
            'equipos_id' => 'required',
        ]);

        // editar fecha
        $fechaNacimiento = new \DateTime($request->input('fecha_nacimiento'));
        $hoy = new \DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;

       
        // editar documentos
        $documentoanterior = $jugador->documentos;

        if ($request->hasFile('documentos')) {
            if (!empty($documentoanterior)) {
                Storage::delete($documentoanterior);
            }

            $file = $request->file('documentos');
            $fileName = 'Autorizacion-' . $request->input('nombres') . '-' . $request->input('apellido_paterno') . '-' . $request->input('dni') . '.' . $file->getClientOriginalExtension();
            $docs = $file->storeAs('public/jugadores/documentos', $fileName);
            $url = Storage::url($docs);
            $jugador->documentos = $url;
        }

        // archivo de ficha médica
        $fichaanterior = $jugador->ficha_medica;

        if ($request->hasFile('ficha_medica')) {
            if (!empty($fichaanterior)) {
                Storage::delete($fichaanterior);
            }

            $file = $request->file('ficha_medica');
            $fileName = 'FichaMedica-' . $request->input('nombres') . '-' . $request->input('apellido_paterno') . '-' . $request->input('dni') . '.' . $file->getClientOriginalExtension();
            $ficha = $file->storeAs('public/jugadores/ficha_medica', $fileName);
            $url = Storage::url($ficha);
            $jugador->ficha_medica = $url;
        }
        // editar foto
        if ($request->hasFile('foto')) {
            // Si hay una foto nueva, eliminar la anterior
            if (!empty($fotoanterior)) {
                Storage::delete($fotoanterior);
            }
    
            $imagen = $request->file('foto');
            $fileName = 'foto_' . $id . '.' . $imagen->getClientOriginalExtension();
            $rutaImagen = $imagen->storeAs('public/jugadores/foto', $fileName);
    
            $jugador->foto = Storage::url($rutaImagen);
        }
        $jugador->apellido_paterno = $request->input('apellido_paterno');
        $jugador->apellido_materno = $request->input('apellido_materno');
        $jugador->nombres = $request->input('nombres');
        $jugador->dni = $request->input('dni');
        $jugador->departamento = $request->input('departamento');
        $jugador->provincia = $request->input('provincia');
        $jugador->distrito = $request->input('distrito');
        $jugador->estado_civil = $request->input('estado_civil');
        $jugador->trabaja = $request->input('trabaja');
        $jugador->estudia = $request->input('estudia');
        $jugador->talla = $request->input('talla');
        $jugador->peso = $request->input('peso');
        $jugador->domicilio = $request->input('domicilio');
        $jugador->nombre_padre = $request->input('nombre_padre');
        $jugador->nombre_madre = $request->input('nombre_madre');
        $jugador->grupo_sanguineo = $request->input('grupo_sanguineo');
        $jugador->fecha_nacimiento = $request->input('fecha_nacimiento');
        $jugador->edad = $edad;
        $jugador->posicion = $request->input('posicion');
        $jugador->dorsal = $request->input('dorsal');
        $jugador->club_origen = $request->input('club_origen');
        $jugador->equipos_id = $request->input('equipos_id');
        $jugador->estado = true;

        $equipo = Equipo::with('categoria')->find($jugador->equipos_id);
    
        if ($edad < $equipo->categoria->edad_minima || $edad > $equipo->categoria->edad_maxima) {
            return redirect()->back()->with('error', 'El jugador no cumple con los requisitos de edad para este equipo.');
        }       



        $jugador->save();
        return redirect()->route('jugadores.index')->with('update', 'El jugador se actualizó con éxito');
        // return dd($jugador);
        
        
        



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        /*
        $categoria = Category::find($id);
            if ($categoria->estado == 1) {
                DB::table('categorys')->where('id', $id)->update(['estado' => 0]);
                return redirect()->route('categorias.index');
            }
            DB::table('categorys')->where('id', $id)->update(['estado' => 1]);
            return redirect()->route('categorias.index');
        */

        $jugador = Jugador::find($id);
        if ($jugador->estado == 1) {
            DB::table('jugadors')->where('id', $id)->update(['estado' => 0]);
            return redirect()->route('jugadores.index');
        }
        DB::table('jugadors')->where('id', $id)->update(['estado' => 1]);
        return redirect()->route('jugadores.index');


    }

    public function generarInformePDF()
    {   
        $jugadores = Jugador::with('equipos')
        ->orderBy('id', 'asc')->get();
        $data = [
            'jugadores' => $jugadores,
        ];
    
        $pdf = PDF::loadView('pdf.jugadores_reporte', $data);
    
        return $pdf->download('jugadores_reporte.pdf');
    }
    
    public function PDFnuevo()
    {
        $msg = Jugador::latest()->first();
        $data =[
            'msg' => $msg,
        ];
        /*$pdf = new Dompdf();*/
        $pdf = PDF::loadView('pdf.jugador_nuevo', $data);
        return $pdf->download('Jugador_Nuevo.pdf');
    }
}
