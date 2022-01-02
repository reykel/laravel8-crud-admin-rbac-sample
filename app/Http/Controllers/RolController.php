<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    public function __construct(){
         $this->middleware('permission:roles.index|roles.create|roles.edit|roles.destroy', ['only'=>['index']]);
         $this->middleware('permission:roles.create', ['only'=>['create', 'store']]);
         $this->middleware('permission:roles.edit', ['only'=>['edit', 'update']]);
         $this->middleware('permission:roles.destroy', ['only'=>['destroy']]);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Role::all();
        //return view('roles.index')->with('model', $model);
        return view('roles.index',compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = Permission::get();
        return view('roles.create',compact('model'));

        /*
        $model = Permission::all();
        return view('roles.create')->with('model', $model);
        */
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $model = Role::create(['name' => $request->input('name')]);
        $model->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index');

        /*
        $this->validate($request, ['name'=>'required', 'permission'=>'required']);
        $model = Role::create(['name'=> $request->get('name')]);
        $model->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index');
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('model','permission','rolePermissions'));

        /*
        $model = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('model', 'permission', 'rolePermissions'));
        */
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
        /*
        $this->validate($request, ['name'=>'required', 'permission'=>'required']);

        $model = Role::find($id);
        $model->name = $request->get('name');

        $model->save();

        $model->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index');
        */
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $model = Role::find($id);
        $model->name = $request->input('name');
        $model->save();
    
        $model->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index');  
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
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles.index');
        */
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index'); 
    }
}
