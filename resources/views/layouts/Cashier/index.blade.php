@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="grid grid-cols-2 gap-4">
        <!-- show mesas -->
        <div class="grid grid-cols-1 grid-rows-2 gap-2">
            <div class="w-full">
                <button id="btn-show-tables" class="w-full rounded-md border border-blue-600 bg-blue-500 text-white ring-1 py-2 font-bold">Mesas Disponibles</button>
            </div>
            <div id="table-details" class="grid grid-rows-3 grid-flow-col gap-2">
                <!-- mesas -->
            </div>
        </div>
        <!-- show categorias -->
        <div class="custom-scrollbar w-full h-fit overflow-y-auto bg-slate-900 shadow-xl shadow-slate-500 rounded-xl">
            <nav class="w-screen m-2 h-auto ">
                <ul class="flex flex-row p-2 backdrop-blur">
                    @foreach($category as $c)
                    <li class="w-full text-center py-1 px-0">
                        <a class="click_menu text-white/80" data-id="{{$c->id}}">{{$c->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <!-- show data for tables  -->
        <div class="flex flex-col gap-4">
            <div id="select_table"></div>
            <div id="order-details"></div>

        </div>

        <!-- mostrar lo que hay dentro de cada categoria -->
        <div id="show_contentCategory" class="w-full grid grid-cols-4 grid-row-3 gap-2 list_menu"></div>
    </div>
</div>


<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
        <div class="bg-white p-6">
            <h3 class="text-xl leading-6 font-bold text-gray-900 ">Total a Pagar</h3>
            <div class="mt-2">
                <div>
                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900 totalAmount"></label>
                    <div class="relative mt-2 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center p-2">
                            <span class="text-gray-500 sm:text-sm">S/.</span>
                        </div>
                        <input type="number" name="price" id="recieved-amount" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <label for="payment-type" class="sr-only font-bold">Tipo de pago:</label>
                            <select id="payment-type" name="currency" class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                <option value="cash">Efectivo</option>
                                <option value="credit">Tarjeta</option>
                                <option value="yape">Yape</option>
                            </select>
                        </div>
                    </div>
                    <hr class="mt-2">
                    <span class="span-changeAmount leading-1 mt-5"></span>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" id="closeModalButton">Cerrar</button>
            <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm btn-save-payment opacity-15" disabled>Pagar</button>
        </div>
    </div>
</div>
@endsection