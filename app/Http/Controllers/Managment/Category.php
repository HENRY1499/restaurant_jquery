<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\Category as MCategory;
use Illuminate\Http\Request;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category=MCategory::getAll();
        return view("layouts.managment.Category.category",compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("layouts.managment.Category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|unique:categories'
        ]);
        $category = new MCategory;
        $category->name = $request->name;
        $category->save();
        $request->session()->flash('status',$request->name. ' agregado a Categorias.');
        return  (redirect('/managment/category'));

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
    public function edit($id)
    {
        $category=MCategory::find($id);
        return view('layouts.managment.Category.edit',compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'=>'required|unique:categories'
        ]);
        $category = MCategory::find($id);
        $category->name = $request->name;
        $category->save();
        $request->session()->flash('status',' La categoria'. $request->name .' editado correctamente');
        return  (redirect('/managment/category'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        MCategory::destroy($id);
            Session()->flash('status','La categoria fue eliminado correctamente');
            return redirect('/managment/category');
    }
}
