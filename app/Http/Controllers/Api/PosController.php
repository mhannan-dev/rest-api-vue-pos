<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PosController extends Controller
{
    public function subProducts($id)
    {
        $product = DB::table('products')->where('category_id', $id)->get();
        return response()->json($product);
    }
    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'paymentMode' => 'required'
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'errors' => $validator->errors(),
            ], 401);
        }
        $data = array();
        $data['customer_id']    = $request->customer_id;
        $data['qty']            = $request->cartQty;
        $data['sub_total']      = $request->subTotal;
        $data['vat_amount']     = $request->vatAmt;
        $data['vat_amount']     = $request->vatAmt['vat'];
        $data['total']          = $request->total;
        $data['pay_amount']     = $request->paymentAmount;
        $data['due_amount']     = $request->dueAmount;
        $data['pay_by']         = $request->paymentMode;
        $data['order_date']     = date('d/m/y');
        $data['order_month']    = date('F');
        $data['order_year']     = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        $posData = DB::table('poss')->get();
        $orderData = array();
        foreach ($posData as $myPosData) {
            $orderData['order_id'] = $order_id;
            $orderData['product_id'] = $myPosData->product_id;
            $orderData['product_qty'] = $myPosData->product_qty;
            $orderData['product_price'] = $myPosData->product_price;
            $orderData['sub_total'] = $myPosData->sub_total;
            DB::table('order_details')->insert($orderData);

            DB::table('products')
                ->where('id', $myPosData->product_id)
                ->update(['buying_quantity' => DB::raw('buying_quantity -' . $myPosData->product_qty)]);
        }
        DB::table('poss')->delete();
        return response('okay');
    }
}
