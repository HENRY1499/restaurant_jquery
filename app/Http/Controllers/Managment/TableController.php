<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables=Table::all();
        return view('layouts.managment.table.table',compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.managment.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:tables'
        ]);
        $tables= new Table;
        $tables->name=$request->name;
        $tables->save();
        $request->session()->flash('status', $request->name . ' fue agregado a Mesas.');
        return (redirect('managment/table'));
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
    public function edit(string $id)
    {
        $tables = Table::find($id);
        return view('layouts.managment.table.edit',compact('tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|unique:tables'
        ]);
        $tables = Table::find($id);
        $tables->name=$request->name;
        $tables->save();
        $request->session()->flash('status', $request->name . ' fue actualizado.');
        return (redirect('mangment/table'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $tables = Table::destroy($id);
        $request->session()->flash('status',$request->name.'fue eliminado');
        return (redirect('managment/table'));

    }
}
