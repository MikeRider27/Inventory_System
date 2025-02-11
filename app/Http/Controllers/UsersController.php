<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sucursales;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    //public function FirstUser()
    //{
    //    User::create([
    //        'name' => 'Miguel Villalba',
    //        'email' => 'admin@gmail.com',
    //        'photo' => '',
    //        'estado' => '1',
    //        'last_login' => '',
    //        'rol' => 'Administrador',
    //        'password' => Hash::make('123'),
    //        'id_sucursal' => 0,
    //    ]);
    //}

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ActualizarPerfil(Request $request)
    {
        $datos = request();

        if(auth()->user()->email != request('email'))
        {
            if(request('password'))
            {
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:50'],
                    'email' => ['required', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:3'],
                ]);
            }
            else
            {
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:50'],
                    'email' => ['required', 'email', 'max:255', 'unique:users'],
                ]);
            }            
        }
        else
        {
            if(request('password'))
            {
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:50'],
                    'email' => ['required', 'email'],
                    'password' => ['required', 'string', 'min:3'],
                ]);
            }
            else
            {
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:50'],
                    'email' => ['required', 'email'],
                ]);
            }  
        }   
        
        if(request('photo'))
        {
            if(auth()->user()->photo != '')
            {
                $path = storage_path('app/public/' . auth()->user()->photo);
                unlink($path);
            }
            $rutaImg = request('photo')->store('users', 'public');
        }
        else
        {
            $rutaImg = auth()->user()->photo;
        }

        if(isset($datos['password']))
        {
            DB::table('users')->where('id', auth()->user()->id)->update([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'photo' => $rutaImg,
                'password' => Hash::make($datos['password']),
            ]);
        }
        else
        {
            DB::table('users')->where('id', auth()->user()->id)->update([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'photo' => $rutaImg,
            ]);
        }

        return redirect('Perfil')->with('success', 'Perfil actualizado con éxito');
    }
          


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->rol != 'Administrador')
        {
            return redirect('home');
        }

        $usuarios = User::all();
        $sucursales = Sucursales::where('estado', 1)->get();

        return view('modules.users.usuarios', compact('usuarios', 'sucursales'));
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
        $validateEmail = request()->validate([
            'email' => ['unique:users'],
        ]);

        $datos = request();

        if($datos['rol'] == 'Administrador')
        {
            $id_sucursal = 0;
        }else
        {
            $id_sucursal = $datos['id_sucursal'];
        }

        User::create([
            'name' => $datos['name'],
            'email' => $validateEmail['email'],
            'photo' => null,
            'estado' => 1,
            'last_login' => null,
            'rol' => $datos['rol'],
            'password' => Hash::make($datos['password']),
            'id_sucursal' => $id_sucursal,
        ]);

        return redirect('Usuarios')->with('success', 'Usuario creado con éxito');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function CambiarEstado($id_usuario, $estado)
    {
        User::find($id_usuario)->update([
            'estado' => $estado
        ]);

        return redirect('Usuarios');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
