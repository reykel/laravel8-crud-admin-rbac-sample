<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('permission:users.index|users.create|users.edit|users.destroy', ['only'=>['index']]);
        $this->middleware('permission:users.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:users.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:users.destroy', ['only'=>['destroy']]);
    }
    
    public function index()
    {
        $model = User::all();
        //return view('users.index')->with('model', $model);
        return view('users.index',compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
       // return view('users.create')->with('roles', $roles);
        return view('users.create',compact('roles'));
        
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles'=>'required'
        ]);

/*
        $model = new User();

        $model->name = $request->input('name');
        $model->email = $request->input('email');
        $model->password = Hash::make($request->input('password'));

        $model->save();

        $model->assignRole($request->input('roles'));

        return redirect('/users');
*/


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index');



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $model = User::find($id);
        //return view('users.edit')->with('model', $model)->with('roles', $roles);
        return view('users.edit',compact('model','roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'roles'=>'required'
        ]);

        $model = User::find($id);

        $model->name = $request->input('name');
        $model->email = $request->input('email');

        $model->roles()->sync($request->input('roles'));
        
        $model->save();

        //return redirect('/users');
        return redirect()->route('users.index');
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
        $model = User::find($id);
        
        $model->delete();

        return redirect('/users')->with('deleted', '-1');
        */
        DB::table("users")->where('id',$id)->delete();
        return redirect()->route('users.index'); 
    }
}
