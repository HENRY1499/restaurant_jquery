<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::paginate(5);
        return view('layouts.managment.Menu.menu', compact("menus"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('layouts.Managment.Menu.create', compact("category"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required",
            "price" => "required",
            "description" => "required",
            "category_id" => "required"
        ]);
        $default = "default.jpg";
        if ($request->image) {
            $request->validate([
                "image" => "nullable|required|file|image|mimes:jgp,png,jpeg|max:5000"
            ]);
            $default = date("mdYHis") . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('img/menu_images'), $default);
        }
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->image = $default;
        $menu->description = $request->description;
        $menu->category_id = $request->category_id;
        $menu->save();
        $request->session()->flash('status', $request->name . ' agregado a Menus.');
        return (redirect('managment/menu'));
    }


    public function edit(string $id)
    {
        $menus = Menu::find($id);
        $category = Category::all();
        return view('layouts.managment.menu.edit', compact('menus', 'category'));
    }

    public function show($id)
    {
    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            "name" => "required|unique:menus",
            "price" => "required",
            "description" => "required",
            "category_id" => "required"
        ]);
        $menu = Menu::find($id);

        $default = 'default.jpg';
        if ($request->image) {
            $request->validate([
                'image' => "required|file|image|mimes:jpg,jpge,png|max:5000"
            ]);
            if ($request->image != "default.jpg") {
                $default = $menu->image;
                unlink(public_path('img/menu_images' . '/' . $default));
            }
            $default = date("mdYHis") . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('img/menu_images'), $default);
        }else{
            $default = $menu->image;
        }
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->image = $default;
        $menu->description = $request->description;
        $menu->category_id = $request->category_id;
        $menu->save();
        $request->session()->flash('status', $request->name . ' editado a Menus.');
        return (redirect('/managment/menu'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menus = Menu::destroy($id);
        Session()->flash('status', 'El menú fue eliminado correctamente');
        return redirect('/managment/menu');
    }
}
