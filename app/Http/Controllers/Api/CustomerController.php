<?php

namespace App\Http\Controllers\Api;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        //dd($customers);
        return response()->json($customers, 200);
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
    public function store(Request $request, Customer $customer)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'address' => 'required',
            'mobile' => 'required'

        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'errors' => $validator->errors(),
            ], 401);
        }
        try {
            //Saving other field to posts table
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->mobile = $request->mobile;
            $customer->save();
            return response()->json([
                'success' => true,
                'message' => 'customer Saved successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'customer not saved',
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'address' => 'required',
            'mobile' => 'required'
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 401);
        }
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['mobile'] = $request->mobile;
        $user = DB::table('customers')->where('id', $id)->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            if (!is_null($customer)) {
                $customer->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'This customer has been deleted',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'This customer not deleted',
            ], 400);
        }
    }
}
