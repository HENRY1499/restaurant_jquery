<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagmentController extends Controller
{
    public function index(){
        return view("layouts.managment.index");
    }
   
}
