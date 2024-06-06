<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>BRILLA - Report {{$sale->id}}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Encabezado del Reporte -->
    <header class="container mx-auto bg-blue-800 text-white p-4">
        <h1 class="text-3xl font-bold text-center">BRILLA - Cuenta de {{$sale->user_name}}</h1>
    </header>

    <!-- Contenedor Principal -->
    <main class="relative container mx-auto mt-8 p-4">
        <!-- Información General -->
        <section class="mb-8">
            <h2 class="text-5xl font-semibold mb-4 text-center uppercase">Información General</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col gap-2">
                    <h3 class="text-lg font-extrabold">Empresa</h3>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Lugar: <span class="text-[12px] font-bold leading-none ">Trujillo - La Esperanza</span></h3>
                    </div>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Dirección: <span class="text-[12px] font-bold leading-none ">Av.Granchimu #969</span></h3>
                    </div>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Celular: <span class="text-[12px] font-bold leading-none ">922516022</span></h3>
                    </div>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Id de referencia: <span class="text-[12px] font-bold leading-none ">{{$sale->id}}</span></h3>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col gap-2">
                    <h3 class="text-lg font-extrabold">Total de Clientes</h3>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Cliente: <span class="text-[12px] font-bold leading-none "> {{$sale->user_name}}</span></h3>
                    </div>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Pago con: <span class="text-[12px] font-bold leading-none "> {{$sale->total_recieved}}</span></h3>
                    </div>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Precio Total: <span class="text-[12px] font-bold leading-none "> {{$sale->total_price}}</span></h3>
                    </div>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Vuelto: <span class="text-[12px] font-bold leading-none "> {{$sale->change}}</span></h3>
                    </div>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Medio de Pago: <span class="text-[12px] font-bold leading-none "> {{$sale->payment_type}}</span></h3>
                    </div>
                    <div class="border py-2 px-1 rounded-md shadow-inner shadow-slate-200 bg-white">
                        <h3 class="text-sm font-medium">Estado: <span class="text-[12px] font-bold leading-none "> {{$sale->status}}</span></h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tabla de Detalles -->
        <section>
            <h2 class="text-xl font-semibold mb-4">Detalles de compra</h2>
            <div class=" bg-white overflow-auto rounded-lg shadow-md">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm uppercase font-semibold text-gray-700">ID</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm uppercase font-semibold text-gray-700">Menú</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm uppercase font-semibold text-gray-700">Cantidad</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm uppercase font-semibold text-gray-700">Precio</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm uppercase font-semibold text-gray-700">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salesDetails as $sales_d)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{$sales_d->menu_id}}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{$sales_d->menu_name}}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{$sales_d->quantity}}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{$sales_d->menu_price}}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{$sales_d->menu_price * $sales_d->quantity}}</td>
                        </tr>
                        @endforeach
                        <!-- Repite las filas según los datos -->
                    </tbody>
                </table>
            </div>
        </section>
        <div class="w-full h-0 absolute bottom-0 left-4 bg-gray-500" >
            <a href="/cashier" class="w-3/12 bg-green-400 py-2 px-4 rounded-md text-white">Inicio</a>
        </div>
    </main>

</body>

</html>