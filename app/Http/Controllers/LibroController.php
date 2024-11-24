<?php

namespace App\Http\Controllers;

use App\Models\libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'volId' => 'required|string',
        ]);
    
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirigir a la página de login si no está autenticado
        }
    
        try {
            // Crear el registro en la base de datos
            Libro::create([
                'volId' => $validatedData['volId'],
                'usuario_id' => Auth::id(),
            ]);
    
            return redirect()->back()->with('mensaje', 'Libro agregado exitosamente');
        } catch (\Exception $e) {
            // Loguear el error
            Log::error('Error al agregar el libro: ' . $e->getMessage());
            return redirect()->back()->with('mensaje', 'Hubo un error al agregar el libro');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, libro $libro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($volId)
    {
        // Buscar el libro por el volId y el usuario autenticado
        $libro = Libro::where('usuario_id', Auth::id())->where('volId', $volId)->first();
    
        // Verificar si el libro existe
        if ($libro) {
            // Eliminar el libro
            $libro->delete();
    
            // Redirigir con mensaje de éxito
            return back()->with('mensaje', 'El libro ha sido eliminado de tu estantería');
        }
    
        // Si no se encuentra el libro, redirigir con mensaje de error
        return back()->with('mensaje', 'No se encontró el libro');
    }
    
 }

