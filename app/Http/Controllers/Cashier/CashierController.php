<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Table;
use App\Models\Sales;
use App\Models\Sales_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('layouts.cashier.index', compact("category"));
    }
    public function getTables()
    {
        $tables = Table::all();
        $html = "";
        foreach ($tables as $table) {
            $html .= '<div class="w-[16rem] rounded-md bg-green-400 p-2 btn-details" data-id="' . $table->id . '" data-name="' . $table->name . '">';
            $html .= $table->name;
            $html .= '</div>';
        }
        return $html;
    }
    public function getMenuByCategory($category_id)
    {
        $menus = Menu::where("category_id", $category_id)->get();
        $html = "";
        foreach ($menus as $m) {
            $html .= '
            <div class="text-center">
            <div class="border-2 ring-8 border-blue-600 py-2 px-4 rounded-md btn-menu" data-id="' . $m->id . '">
                <img class="w-full h-32" src="' . url('img/menu_images/', $m->image) . '" >
                <br>
                ' . $m->name . '
                <br>
                ' . number_format($m->price) . '
                </div> 
            </div>
            ';
        }
        return $html;
    }
    public function orderFood(Request $request)
    {
        //$request menu_id, viene de la solicitud POST de la ruta cashier/orderFood 
        $menu = Menu::find($request->menu_id);
        // tambien viene de ajax, solicitud POST
        $table_id = $request->table_id;
        $table_name = $request->table_name;
        // se comienza a guardar los datos recolectados desde la $request del POST de la ruta "cashier/orderFood"
        $sales = Sales::where('table_id', $table_id)->where('status', "unpaid")->first();
        // si no hay ninuna sales(venta) para la mesa(table), vamos a crear una nueva venta
        if (!$sales) {
            $user = Auth::user();
            $sales = new Sales();
            $sales->table_id = $table_id;
            $sales->table_name = $table_name;
            $sales->user_id = $user->id;
            $sales->user_name = $user->name;
            // $sales -> total_recieved,
            // $sales -> change, 
            // $sales -> payment_type,
            // $sales -> status
            $sales->save();
            $sales_id = $sales->id;

            // Cambiar el estado de la mesa
            $table = Table::find($table_id);
            $table->status = "unavailable";
            $table->save();
        } else {
            $sales_id = $sales->id;
        }
        // agregar la orden de menu a la tabla de detalles ventas
        $salesDetails = new Sales_detail();
        $salesDetails->sales_id = $sales_id;
        $salesDetails->menu_id = $menu->id;
        $salesDetails->menu_name = $menu->name;
        $salesDetails->menu_price = $menu->price;
        $salesDetails->quantity = $request->quantity;
        $salesDetails->save();

        // actualizar el precio total de sales(ventas)
        $sales->total_price = $sales->total_price + ($request->quantity * $menu->price);
        // $sales -> total_recieved,
        // $sales -> change, 
        // $sales -> payment_type,
        // $sales -> status
        $sales->save();

        $html = $this->getSaleDetails($sales_id);

        return $html;
    }

    private function getSaleDetails($sales_id)
    {
        //  lista de todos los detalles de la venta
        $html = '<p>Venta ID: ' . $sales_id . '</p>';
        $salesDetails = Sales_detail::where('sales_id', $sales_id)->get();
        $html .= '<div class="w-full border p-2"><div class="flex flex-col gap-2">';
        $showButtonPayment = true;
        foreach ($salesDetails as $sd) {

            $html .= '
             <div class="w-3/5 bg-green-200 rounded-md border px-2">' . $sd->menu_id . '</div>
             <div class="w-3/5 bg-green-200 rounded-md border">' . $sd->menu_name . '</div>
             <div class="w-3/5 bg-green-200 rounded-md border">' . $sd->quantity . '</div>
             <div class="w-3/5 bg-green-200 rounded-md border">' . $sd->menu_price . '</div>
             <div class="w-3/5 bg-green-200 rounded-md border">' . ($sd->menu_price * $sd->quantity) . '</div>';
            if ($sd->status == "noConfirm") {
                $showButtonPayment = false;
                $html .= '<a data-id="' . $sd->id . '" class="btn-delete">🚮</a>';
            } else {
                // si el status es confirm
                $html .= '<div>✅</div>';
            }
        }

        $html .= ' </div></div>';
        $sale = Sales::find($sales_id);
        $html .= '<hr>';
        $html .= '<h5>Total: S/.' . number_format($sale->total_price) . ' </h5>';
        if ($showButtonPayment) {
            $html .= '<button id="openModalButton" class="bg-green-400 border px-2 py-4 btn-confirm-order btn-payment " data-totalAmount="' . $sale->total_price . '" data-id="' . $sales_id . '" >Payment</button>';
        } else {
            $html .= '<button class="bg-red-400 border px-2 py-4 btn-confirm-order" data-id="' . $sales_id . '">Orden Confirmada</button>';
        }
        return $html;
    }

    public function getSaleDetailsByTable($table_id)
    {
        $html = "";
        $sale = Sales::where('table_id', $table_id)->where('status', 'unpaid')->first();
        if ($sale) {
            $sale_id = $sale->id;
            $html .= $this->getSaleDetails($sale_id);
        } else {
            $html .= "No se encontro ninguna tabla seleccionada por este temprnlos";
        }
        return $html;
    }

    public function confirmOrderStatus(Request $request)
    {
        $sale_id = $request->sale_id;
        $salesDetails = Sales_detail::where('sales_id', $sale_id)->update(['status' => "Confirm"]);
        $html =  $this->getSaleDetails($sale_id);
        return $html;
    }

    public function deleteSetails(Request $request)
    {
        $salesDetails_id = $request->saleDetail_id;
        $salesDetails = Sales_detail::find($salesDetails_id);
        $sale_id = $salesDetails->sales_id;
        $menu_price = ($salesDetails->menu_price * $salesDetails->quantity);
        $salesDetails->delete();

        // actualizar total price
        $sale = Sales::find($sale_id);
        $sale->total_price = $sale->total_price - $menu_price;
        $sale->save();

        $salesDetails = Sales_detail::where('sales_id', $sale_id)->first();
        if ($salesDetails) {
            $html = $this->getSaleDetails($sale_id);
        } else {
            $html = "No se encontro ninguna tabla seleccionada por este temprnlos";
        }
        return $html;
    }
    public function paymentsave(Request $request)
    {
        $SALE_ID = $request->sale_id;
        $RECIEVED_AMOUNT = $request->recievedAmount;
        $PAYMENT_TYPE = $request->paymentType;
        $sale = Sales::find($SALE_ID);
        $sale->total_recieved = $RECIEVED_AMOUNT;
        $sale->change = $RECIEVED_AMOUNT - $sale->total_price;
        $sale->payment_type = $PAYMENT_TYPE;
        $sale->status = "paid";
        $sale->save();
        // liberar mesa
        $table = Table::find($sale->table_id)->first();
        $table->status = "avaible";
        $table->save();
        return "/cashier/showReceipt/" . $SALE_ID;
    }
    public function showReceipt($sale_id)
    {
        $sale = Sales::find($sale_id)->first();
        $salesDetails=Sales_detail::where('sales_id',$sale_id)->get();
        return view('layouts/cashier/report',compact('sale','salesDetails'));
    }
}
