<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('layouts/managment/user/user', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts/managment/user/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect("managment/user");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $user = User::find($id);
        return view("layouts.managment.user.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => "required",
            'role' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect("managment/user");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::destroy($id);
        return (redirect("managment/user"));
    }
}
