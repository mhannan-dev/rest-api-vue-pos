<?php

namespace App\Http\Controllers\Api;

use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sal = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->orderBy('salaries.id', 'DESC')->get();
        return response()->json($sal, 200);
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
    public function store(Request $request, Salary $Salary)
    {
        $validator = Validator::make($request->all(), [
            'details' => 'required',
            'amount' => 'required',
            'Salary_date' => 'required',
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'errors' => $validator->errors(),
            ], 401);
        }
        try {
            $Salary->details = $request->details;
            $Salary->amount = $request->amount;
            $Salary->Salary_date = date('Y-m-d', strtotime($request->Salary_date));
            $Salary->save();
            return response()->json([
                'success' => true,
                'message' => 'Salary saved successfully',
            ], 200);
        } catch (\Throwable $th) {
            //dd($th);
            return response()->json([
                'success' => false,
                'message' => 'Salary not saved',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $Salary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Salary::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $Salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $Salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $Salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'details' => 'required',
            'amount' => 'required',
            'Salary_date' => 'required'
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 401);
        }
        try {
            $Salary = Salary::findOrFail($id);
            $Salary->details = $request->details;
            $Salary->amount = $request->amount;
            $Salary->Salary_date = $request->Salary_date;
            $Salary->update();
            return response()->json([
                'success' => true,
                'message' => 'Salary updated successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => 'Salary not updated',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $Salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $Salary = Salary::findOrFail($id);
            $Salary->delete();
            return response()->json([
                'success' => true,
                'message' => 'This Salary has been deleted',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'This Salary not deleted',
            ], 400);
        }
    }
}
