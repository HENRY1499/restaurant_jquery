@extends('layouts.app')

@section('content')
<div class="container m-auto bg-slate-900 p-2 rounded-3xl shadow-inner shadow-slate-400">
    <div class="w-full min-h-[45rem]">
        <div class="w-full bg-blue-20">
            <div class="text-6xl mt-2 text-white font-bold uppercase text-center">Panel de control</div>

            <div class="card-body mt-5">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <div class="h-full p-5">
                    <div class="w-full flex justify-center items-center gap-5">
                        @if(Auth::user()->checkAdmin())
                        <div class="w-3/5 border-green-100 p-2">
                            <example-card :img-dynamic="'{{asset('img/cars.png')}}'" title="Managment" ruta-link="managment"></example-card>
                        </div>
                        @endif
                        <div class="w-3/5 h-1/3">
                             <example-card :img-dynamic="'{{asset('img/cars.png')}}'" title="Cashier" ruta-link="cashier"></example-card>
                        </div>
                        @if(Auth::user()->checkAdmin())
                        <div class="w-3/5 h-1/3">
                             <example-card :img-dynamic="'{{asset('img/cars.png')}}'" title="Report" ruta-link="report"></example-card>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection