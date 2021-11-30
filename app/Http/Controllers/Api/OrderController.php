<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function todayOrders()
    {
        $data = date('d/m/y');
        $todayOrders = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->where('order_date', $data)
            ->select('customers.name', 'orders.*')
            ->orderBy('orders.id', 'DESC')
            ->get();
        //dd($todayOrders);
        return response()->json($todayOrders, 200);
    }
    public function orderDetails($id)
    {
        $order = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->where('orders.id', $id)
            ->select('customers.name', 'customers.address', 'customers.mobile', 'orders.*')
            ->first();
        //dd($order);
        return response()->json($order, 200);
    }

    public function orderDetailAll($id)
    {
        $orderDetailAll = DB::table('order_details')
            ->join('products', 'order_details.product_id', 'products.id')
            ->where('order_details.order_id', $id)
            ->select('products.title', 'products.code', 'products.product_image', 'order_details.*')
            ->get();
        //dd($orderDetailAll);
        return response()->json($orderDetailAll);
    }
    public function searchOrder(Request $request)
    {
        $orderDate = $request->date;
        $newDate = new DateTime($orderDate);
        $formatDate = $newDate->format('d/m/y');
        $orders = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->select('customers.name', 'orders.*')
            ->where('orders.order_date', $formatDate)
            ->get();
        //dd($orders);
        return response()->json($orders);
    }

    public function todayTotal(Request $request)
    {
        $orderDate = date('d/m/y');
        $orders = DB::table('orders')
            ->where('order_date', $orderDate)
            ->sum('total');
        return response()->json($orders);
    }
    public function todayRcvdAmount(Request $request)
    {
        $orderDate = date('d/m/y');
        $rcvdAmount = DB::table('orders')
            ->where('order_date', $orderDate)
            ->sum('pay_amount');
        return response()->json($rcvdAmount);
    }

    public function todayDueAmount()
    {
        $orderDate = date('d/m/y');
        $dueAmt = DB::table('orders')
            ->where('order_date',$orderDate)
            ->sum('due_amount');
        return response()->json($dueAmt);
    }
    public function todayExpAmount()
    {
        $expDate = date('Y-m-d');
        $expAmt = DB::table('expenses')
            ->where('expense_date',$expDate)
            ->sum('amount');
        return response()->json($expAmt);
    }
    public function stockOut()
    {
        $stockOut = DB::table('products')->where('buying_quantity','<','1')->get();
        //$stockOut = DB::statement('SELECT * FROM `products` WHERE buying_quantity < 1');
        return response()->json($stockOut);
    }
}
