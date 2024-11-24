<?php

namespace App\Http\Controllers;

use App\Models\libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class libroGoogleController extends Controller
{
    public function googleSearch(Request $request)
    {
        $query = $request->input('query'); //aqui se va almacenar la parabla para la busqueda

        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $query,
            'key' => env('GOOGLE_BOOKS_API_KEY')
        ]);

        //verificar respuesta
        if ($response->successful()) {
            $books = $response->json('items');
            return view('libro.index', compact('books'));
        } else {
            session()->flash('mensaje', 'Error en la solicitud');
            return view('libro.index');
        }
    }

    public function show( $google)
    {
        
        $response = Http::get('https://www.googleapis.com/books/v1/volumes/' . $google, [
            'key' => env('GOOGLE_BOOKS_API_KEY')
        ]);
        
        
        if ($response->successful()) {
            $book = $response->json();
            $previewLink = $book['volumeInfo']['previewLink'] ?? null;
            return view('libro.show', compact('book', 'previewLink'));
        } else {
            session()->flash('mensaje','No se pudo obtener la información del libro');
            return redirect()->back();
        }
    }

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

    

    
    
    public function estanteria()
    {
        // Obtener todos los volId del usuario autenticado
        $guardados = Libro::where("usuario_id", Auth::id())->pluck('volId');
        $id_libro = Libro::where("usuario_id", Auth::id())->pluck('id');//esto es para poder eliminar el libro;
    
        $books = [];
    
        // Iterar sobre cada volId y realizar la petición a la API de Google Books
        foreach($guardados as $vol) {
            $response = Http::get('https://www.googleapis.com/books/v1/volumes/' . $vol, [
                'key' => env('GOOGLE_BOOKS_API_KEY')
            ]);
    
            // Decodificar la respuesta JSON y agregarla al array de libros
            if ($response->successful()) {
                $books[] = $response->json();
            }
        }
    
        // Pasar el array de libros a la vista
        return view('libro.estanteria', compact('books','id_libro'));
    }
}
