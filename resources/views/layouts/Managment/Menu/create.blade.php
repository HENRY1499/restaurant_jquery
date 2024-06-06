@extends('layouts.app')
@section('content')
<div class="container mx-auto ">
    <!-- content left-right -->
    <div class="flex flex-row ">
        <!-- left -->
        <div class="rounded-xl w-2/12 p-4">
            @include('layouts.managment.inc.navbar')
        </div>
        <!-- right -->
        <div class="w-full rounded-xl shadow-sm shadow-green-400 px-3 mt-2">
            <div class="p-2">
                <div class="flex flex-row justify-between items-center place-items-center">
                    <h1 class="text-black font-bold leading-none">Crear Menú</h1>
                </div>
            </div>
            <hr class="mx-2 border border-black mb-5">


            <form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="flex flex-col gap-2 justify-between w-3/12 max-h-[2em]">
                    <div class="flex flex-col mb-2">
                        <label class="mb-2">Nombre</label>
                        <input placeholder="Ingresar Menú" type="text" name="name" class="p-2 rounded-md outline outline-1 hover:outline-2 focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                    <div class="flex flex-col mb-2">
                        <label class="mb-2">Precio</label>
                        <input placeholder="Ingresar precio" type="decimal" name="price" class="p-2 rounded-md outline outline-1 hover:outline-2 focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                    <!-- DROPZONE -->
                    <div class="custome-file">
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="image" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <!-- END DROPZONE -->
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your text</label>
                        <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Descripción..."></textarea>
                    </div>
                    <div>
                        <label for="category">Category</label>
                        <select id="category" name="category_id" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected="Elegir una categoria"></option>
                            @foreach($category as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white leading-none py-2 px-4 rounded-md transition-all duration-500">
                        Agregar
                    </button>

                </div>

                @if($errors -> any())
                <div class="w-3/12 mt-4 rounded-md shadow-inner shadow-red-100 py-2 p-4 bg-red-700">
                    <ul>
                        @foreach($errors->all() as $error )
                        <li class="text-white font-bold">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </div>
    </div>

</div>
@endsection