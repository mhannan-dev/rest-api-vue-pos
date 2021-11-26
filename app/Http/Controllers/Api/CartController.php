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
        //Insert process to pos table
        $data = array();
        $data['product_id'] = $id;
        $data['product_name'] = $product->title;
        $data['product_qty'] = 1;
        $data['product_price'] = $product->selling_price;
        $data['sub_total'] = $product->selling_price;
        DB::table('poss')->insert($data);
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
}
