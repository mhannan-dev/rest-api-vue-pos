<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
}
