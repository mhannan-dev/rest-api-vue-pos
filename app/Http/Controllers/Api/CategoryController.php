<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json($categories, 200);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'All Category',
        //     'data' => $category,
        // ], 200);
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
    public function store(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255'
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'errors' => $validator->errors(),
            ], 401);
        }
        try {
            $category->category_name = $request->category_name;
            $category->slug =  Str::slug($request->category_name);
            $category->save();
            return response()->json([
                'success' => true,
                'message' => 'Category saved successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Category not saved',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($category);
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories,category_name,'.$id,
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 401);
        }
        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->update();
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            if (!is_null($category)) {
                $category->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'This category has been deleted',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'This category not deleted',
            ], 400);
        }
    }
}
