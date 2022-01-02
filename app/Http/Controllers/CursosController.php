<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\Producto;
use App\Models\Categoria;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
    public function __construct(){
        $this->middleware('permission:cursos.index|cursos.create|cursos.edit|cursos.destroy', ['only'=>['index']]);
        $this->middleware('permission:cursos.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:cursos.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:cursos.destroy', ['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Cursos::all();
        //return view('cursos.index')->with('model', $model);
        return view('cursos.index',compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = Categoria::all();
        //return view('cursos.create')->with('model', $model);
        return view('cursos.create',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|unique:cursos,nombre',
            'id_producto' => 'required',
        ]);

        $model = new Cursos();

        $model->nombre = $request->input('nombre');
        $model->id_producto = $request->input('id_producto');
        
        $model->save();

        //return redirect('/cursos');
        return redirect()->route('cursos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Cursos::find($id);
        $categorias = Categoria::all();

        //return view('cursos.edit')->with('model', $model)->with('categorias', Categoria::all());
        return view('cursos.edit',compact('model','categorias'));
        
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
        $this->validate($request, [
            'nombre' => 'required|unique:cursos,nombre',
            'id_producto' => 'required',
        ]);

        $model = Cursos::find($id);

        $model->nombre = $request->input('nombre');
        $model->id_producto = $request->input('id_producto');
        
        $model->save();

        //return redirect('/cursos');
        return redirect()->route('cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        $model = Cursos::find($id);
        
        $model->delete();

        return redirect('/cursos')->with('deleted', '-1');
        */

        DB::table("cursos")->where('id', $id)->delete();
        return redirect()->route('cursos.index'); 
    }
}
