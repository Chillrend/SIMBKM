<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return view('dashboard.role', [
            'title' => 'Role',
            'title_page' => 'Role',
            'active' => 'Role',
            'name' => auth()->user()->name,
            'roles' => Role::all()
        ]);
    }

    public function create(){
        return view('dashboard.create-role', [
            'title' => 'Role',
            'title_page' => 'Role / Create',
            'active' => 'Role',
            'name' => auth()->user()->name,
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
            'status' => 'required'
        ]);
        Role::create($validatedData);

        return redirect('/dashboard/role')->with('success', 'Role Berhasil Dibuat!');
    }

    public function edit($id){
        return view('dashboard.edit-role',[
            'title' => 'Edit',
            'title_page' => 'Role / Edit',
            'active' => 'Role',
            'name' => auth()->user()->name,
            'role' => Role::find($id)
        ]);
    }

    public function update(Request $request, $role){

        $postingan = Role::find($role);

        $postingan->update($request->all());
        return redirect('/dashboard/role')->with('success', 'Role has been updated!');

    }
}
