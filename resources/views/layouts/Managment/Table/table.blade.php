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
                    <h1 class="text-black font-bold leading-none uppercase">Mesas</h1>
                    <a href="{{route('table.create')}}" class="hover:-translate-y-2 duration-500 px-4 py-2 rounded-md border-none bg-gradient-to-l from-green-400 to-green-600">
                        <font-awesome-icon inverse :icon="['fas', 'plus']"></font-awesome-icon>
                        <span class="text-md text-white leading-none">&nbsp; Agregar</span>
                    </a>
                </div>
            </div>
            <hr class="mx-2 border border-black mb-3">
            @if(Session()->has('status'))
            <span class="w-full bg-green-400 rounded-md px-4 py-2 ">
                {{Session()->get('status')}}
            </span>
            @endif
            <!-- table-vue -->
            <div class="w-full mt-3">
                <table class="w-full border table-fixed">
                    <thead>
                        <tr class="bg-gradient-to-br from-blue-300 to-blue-500">
                            <th class="px-4 text-xl uppercase">ID</th>
                            <th class="px-4 text-xl uppercase">Mesas</th>
                            <th class="px-4 text-xl uppercase">Estado</th>
                            <th class="px-4 text-xl uppercase">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tables as $t)
                        <tr>

                            <td class="py-2 px-4">{{$t->id}}</td>
                            <td class="py-2 px-4">{{$t->name}}</td>
                            <td class="py-2 px-4">
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{$t->status}}</span></td>
                            <td class="py-2 px-4">
                                <div class="flex flex-row gap-4">
                                    <a href="{{route('table.edit',$t->id)}}" class="bg-blue-500 text-white py-2 px-4 rounded-md">Editar</a>
                                    <form method="post" action="{{route('table.destroy',$t->id)}}" class="bg-red-500 text-white py-2 px-4 rounded-md">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Eliminar" class="bg-red-500 text-white rounded-md">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- end table - vue -->
        </div>
    </div>

</div>
@endsection