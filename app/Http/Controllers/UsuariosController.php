<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $usuarios = User::all();

        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $data)
    {
        //$data = User::create([
        //    'name' => $data['name'],
        //    'email' => $data['email'],
        //    'password' => Hash::make($data['password']),
        //]);
        //return view('laboratorios.crear',compact('laboratorios','carreras'));
        $usuarios = User::all();
        //return view('usuarios.crear');
        return view('usuarios.crear');
       // return redirect('/Usuarios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosUsuarios=request()->except('_token');
        User::insert($datosUsuarios);
        return redirect('/Usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario= User::findOrFail($id);
        return view('Usuarios.editar', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nuevoDato=User::find($id);
        $nuevoDato->name = $request->name;
        $nuevoDato->email = $request->email;
        $nuevoDato->save();
        
        return redirect("Usuarios");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = User::destroy($id);
        
        if ($destroy){
            $id=[
                'status'=>'1',
                'msg'=>'success'
            ];
        
        }else{
        
            $id=[
                'status'=>'0',
                'msg'=>'fail'
            ];

        }
        return redirect('/Usuarios');
    }
}
