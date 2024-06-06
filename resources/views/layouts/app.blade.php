<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand font-weight-normal text-danger" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        acá va un alista de menu
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $("#table-details").hide();
            $("#btn-show-tables").click(function() {
                if ($("#table-details").is(":hidden")) {
                    $.get("/cashier/getTables", function(data) {
                        $("#table-details").html(data);
                        $("#table-details").slideDown("fast");
                        $("#btn-show-tables").html("Esconder").removeClass("bg-blue-500").addClass("bg-red-500");

                    })
                } else {
                    $("#table-details").slideUp("fast");
                    $("#btn-show-tables").html("Mostrar").removeClass("bg-red-500").addClass("bg-blue-500");

                }
            });

            $(".click_menu").click(function() {
                $.get('/cashier/getMenuByCategory/' + $(this).data("id"), function(data) {
                    $("#show_contentCategory").html(data)
                });
            });
            SELECT_TABLE_ID = "";
            SELECT_TABLE_NAME = "";
            SALE_ID = "";
            $("#table-details").on("click", ".btn-details", function() {
                SELECT_TABLE_ID = $(this).data("id");
                SELECT_TABLE_NAME = $(this).data("name");

                $("#select_table").html('<br><h3>Table: ' + SELECT_TABLE_NAME + '</h3><hr>')
                $.get('/cashier/getSaleDetailsByTable/' + SELECT_TABLE_ID, function(data) {
                    $("#order-details").html(data);
                });
            });

            $(".list_menu").on("click", ".btn-menu", function() {
                if (SELECT_TABLE_ID === '') {
                    alert("Primero seleccionar una tabla")
                } else {
                    var menu_id = $(this).data("id");
                    $.ajax({
                        type: "POST",
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            "menu_id": menu_id,
                            "table_id": SELECT_TABLE_ID,
                            "table_name": SELECT_TABLE_NAME,
                            "quantity": 1
                        },
                        url: "/cashier/orderFood",
                        success: function(data) {
                            $("#order-details").html(data);
                        }

                    });

                }
            });

            $("#order-details").on("click", ".btn-confirm-order", function() {
                var saleID = $(this).data("id");
                $.ajax({
                    type: "POST",
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "sale_id": saleID,
                    },
                    url: "/cashier/confirmOrderStatus",
                    success: function(data) {
                        $("#order-details").html(data);
                    }

                });
            })
            // borrar detalle de  venta
            $("#order-details").on("click", ".btn-delete", function() {
                var saleDetailID = $(this).data("id");
                $.ajax({
                    type: "POST",
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "saleDetail_id": saleDetailID,
                    },
                    url: "/cashier/deleteSetails",
                    success: function(data) {
                        $("#order-details").html(data);
                    }

                });
            })
            // MODAL
            $("#order-details").on('click', "#openModalButton", function() {
                $('#modal').removeClass('hidden');
            });

            $('#closeModalButton').on('click', function() {
                $('#modal').addClass('hidden');
            });

            // Cerrar el modal al hacer clic fuera de él
            $('#modal').on('click', function(event) {
                if ($(event.target).is('#modal')) {
                    $('#modal').addClass('hidden');
                }
            });

            $("#order-details").on('click', '.btn-payment', function() {
                var total_amount = $(this).attr('data-totalAmount');
                $('.totalAmount').html("Total: " + total_amount);
                $("#recieved-amount").val('');
                $('.span-changeAmount').html('');
                SALE_ID = $(this).data("id");
            });

            // calcular el vuelto
            $("#recieved-amount").keyup(function() {
                var totalAmount = $(".btn-payment").attr("data-totalAmount");
                var reicivedAmount = $(this).val();
                var change = reicivedAmount - totalAmount;
                $('.span-changeAmount').html("Vuelto: " + change);
                if (change >= 0) {
                    $(".btn-save-payment").prop('disabled', false);
                    $(".btn-save-payment").removeClass('opacity-15');
                } else {
                    $(".btn-save-payment").prop('disabled', true);
                }
            })

            // paymente
            $(".btn-save-payment").click(function() {
                var recievedAmount = $("#recieved-amount").val();
                var paymentType = $("#payment-type").val();
                var sale_id = SALE_ID;
                // alert(SALE_ID); 10
                $.ajax({
                    type: "POST",
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "sale_id": sale_id,
                        "recievedAmount": recievedAmount,
                        "paymentType": paymentType
                    },
                    url: "/cashier/paymentsave",
                    success: function(data) {
                        window.location.href = data;
                    }

                });
            })

           







        });
    </script>
</body>

</html>