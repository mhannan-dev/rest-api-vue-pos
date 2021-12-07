<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with([
            'supplier' => function ($query) {
                $query->select('id', 'title');
            }, 'category' => function ($query) {
                $query->select('id', 'category_name');
            },
        ])->latest()->get();
        //dd($products);
        // $products = DB::table('products')
        //     ->join('categories', 'products.category_id', 'categories.id')
        //     ->join('suppliers', 'products.supplier_id', 'suppliers.id')
        //     ->select('suppliers.title', 'categories.category_name', 'products.*')
        //     ->orderBy('products.id', 'DESC')->get();
        return response()->json([
            'success' => true,
            'message' => 'All products',
            'data' => $products,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            'title' => 'required',
            'code' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_image' => 'required',
            'buying_quantity' => 'required',
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'errors' => $validator->errors(),
            ], 401);
        }
        try {
            if ($request->product_image) {
                $position = strpos($request->product_image, ';');
                $sub = substr($request->product_image, 0, $position);
                $ext = explode('/', $sub)[1];
                $name = time() . "." . $ext;
                $img = Image::make($request->product_image)->resize(250, 250);
                $upload_path = 'uploads/product/';
                $image_url = $upload_path . $name;
                $img->save($image_url);
            }
            //Saving other field to products table
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->title = $request->title;
            $product->code = $request->code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = date('Y-m-d', strtotime($request->buying_date));
            $product->buying_quantity = $request->buying_quantity;
            $product->product_image = $image_url;
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product saved successfully!!',
            ], 200);
        } catch (\Throwable $th) {
            //dd($th);
            return response()->json([
                'success' => false,
                'message' => 'Product not saved!!',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            'title' => 'required',
            'code' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_image' => 'required',
            'buying_quantity' => 'required',
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'errors' => $validator->errors(),
            ], 401);
        }
        $data = array();
        $data['title'] = $request->title;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['code'] = $request->code;
        $data['root'] = $request->root;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['buying_date'] = $request->buying_date;
        $data['buying_quantity'] = $request->buying_quantity;
        $product_image = $request->newImage;
        //Upload image
        if ($product_image) {
            $position = strpos($product_image, ';');
            $sub = substr($product_image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . "." . $ext;
            $img = Image::make($product_image)->resize(250, 250);
            $upload_path = 'uploads/product/';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);
            if ($success) {
                $data['product_image'] = $image_url;
                $img = DB::table('products')->where('id', $id)->first();
                $image_path = $img->product_image;
                $done = unlink($image_path);
                $user = DB::table('products')->where('id', $id)->update($data);
            }
        } else {
            $oldImage = $request->product_image;
            $data['product_image'] = $oldImage;
            $user = DB::table('products')->where('id', $id)->update($data);
        }
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        try {
            $image_path = public_path() . '/' . $product->product_image;
            if (!is_null($image_path)) {
                $product->delete();
                unlink($image_path);
            } else {
                $product->delete();
            }
            return response()->json([
                'success' => true,
                'message' => 'This product has been deleted',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'This product not deleted',
            ], 400);
        }
    }

    public function updateStock(Request $request, $id)
    {
        $data = array();
        $data['buying_quantity'] = $request->buying_quantity;
        DB::table('products')->where('id', $id)->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Product Quantity has been updated successfully'
        ], 200);
    }
}
