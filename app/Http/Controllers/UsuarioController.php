<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display the login form.
     */
    public function index()
    {
        return view('user.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.registro');
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        $messages = [
            'nombre.required' => 'El nombre de usuario es obligatorio.',
            'nombre.string' => 'El nombre de usuario debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre de usuario no debe superar los 255 caracteres.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.string' => 'El correo electrónico debe ser una cadena de caracteres.',
            'correo.email' => 'Debe proporcionar una dirección de correo electrónico válida.',
            'correo.max' => 'El correo electrónico no debe superar los 255 caracteres.',
            'correo.unique' => 'El correo electrónico ya está registrado.',
            'pass.required' => 'La contraseña es obligatoria.',
            'pass.string' => 'La contraseña debe ser una cadena de caracteres.',
            'pass.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        // Valida los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios',
            'pass' => 'required|string|min:8',
        ], $messages);

        // Hasheando la contraseña
        $hashedPassword = Hash::make($request->pass);

        // Creando el nuevo usuario
        Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'pass' => $hashedPassword,
        ]);

        return view('user.login'); // Redirige al índice de libros después de crear el usuario
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        // Si lo necesitas, puedes agregar lógica aquí para mostrar un usuario específico
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        // Si necesitas editar un usuario, la lógica irá aquí
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        // La lógica de actualización se agrega aquí si es necesario
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        // Lógica para eliminar un usuario
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'pass' => 'required|string',
        ], [
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Debe proporcionar una dirección de correo electrónico válida.',
            'pass.required' => 'La contraseña es obligatoria.',
        ]);

        // Recuperar los credenciales del formulario
        $credentials = $request->only('correo', 'pass');

        // Intentar encontrar el usuario con el correo proporcionado
        $user = Usuario::where('correo', $credentials['correo'])->first();

        // Verificar si el usuario existe y si la contraseña proporcionada coincide con la almacenada (con Hash::check)
        if ($user && Hash::check($credentials['pass'], $user->pass)) {
            // Autenticación exitosa
            Auth::login($user);
            return view('libro.index'); // Redirige a la página de libros después de iniciar sesión
        }

        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput();
    }

    /**
     * Handle user logout.
     */
    public function logout()
    {
        Auth::logout();
        return view('inicio.welcome'); // Redirige a la página de bienvenida después del logout
    }
}

