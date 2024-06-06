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
                    <h1 class="text-black font-bold leading-none">Crear Usuario</h1>
                </div>
            </div>
            <hr class="mx-2 border border-black mb-5">


            <form action="{{route('user.store')}}" method="POST">
                @csrf
                @method('POST')
                <div class="flex flex-col gap-2 justify-between w-3/12 max-h-[2em]">
                    <div class="flex flex-col mb-2">
                        <label for="user_name" class="mb-2">Nombre</label>
                        <input placeholder="Ingresar Nombre" type="text" name="name" class="p-2 rounded-md outline outline-1 hover:outline-2 focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="user_rol" class="mb-2">Rol</label>
                        <input placeholder="Ingresar Rol" type="text" name="role" class="p-2 rounded-md outline outline-1 hover:outline-2 focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="user-email" class="mb-2">Correo</label>
                        <input placeholder="Ingresar Email" type="email" name="email" class="p-2 rounded-md outline outline-1 hover:outline-2 focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for="user-pass" class="mb-2">Contraseña</label>
                        <input placeholder="Ingresar Contraseña" type="password" name="password" class="p-2 rounded-md outline outline-1 hover:outline-2 focus:outline-none focus:ring focus:border-blue-500">
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