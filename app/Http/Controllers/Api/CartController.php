<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Pos;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {

        //Taking the product
        $product = DB::table('products')->where('id', $id)->first();
        $checkProduct = DB::table('poss')->where('product_id', $id)->first();
        if ($checkProduct) {
            DB::table('poss')->where('product_id', $id)->increment('product_qty');
            $cart_product = DB::table('poss')->where('product_id', $id)->first();
            $subTotal = $cart_product->product_qty *  $cart_product->product_price;
            DB::table('poss')->where('product_id', $id)->update(['sub_total' => $subTotal]);
        } else {
            //Insert process to pos table
            $data = array();
            $data['product_id'] = $id;
            $data['product_name'] = $product->title;
            $data['product_qty'] = 1;
            $data['product_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;
            DB::table('poss')->insert($data);
        }
    }
    public function cartProducts()
    {
        $cartProducts = DB::table('poss')->get();
        return response()->json($cartProducts);
    }
    public function removeCart($id)
    {
        DB::table('poss')->where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Cart item removed successfully',
        ], 200);
    }
    public function incrementCart($id)
    {
        $product_qty = DB::table('poss')->where('id', $id)->increment('product_qty');
        $cart_product = DB::table('poss')->where('id', $id)->first();
        $sub_total = $cart_product->product_qty *  $cart_product->product_price;
        DB::table('poss')->where('id', $id)->update(['sub_total' => $sub_total]);
        return response('Done');
    }
    public function decrementCart($id)
    {
        $product_qty = DB::table('poss')->where('id', $id)->decrement('product_qty');
        $cart_product = DB::table('poss')->where('id', $id)->first();
        $sub_total = $cart_product->product_qty *  $cart_product->product_price;
        DB::table('poss')->where('id', $id)->update(['sub_total' => $sub_total]);
        return response('Done');
    }
    public function vatAmount()
    {
        $vatAmt = DB::table('extras')->first();
        
        return response()->json($vatAmt);
    }
}
