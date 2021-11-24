<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    public function salaryPaid(Request $request, $id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'month' => 'required',
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'errors' => $validator->errors(),
            ], 401);
        }
        $month = $request->month;
        $checkSalaryMonth = DB::table('salaries')->where('employee_id', $id)->where('month', $month)->first();
        if ($checkSalaryMonth) {
            return response()->json('Salary already paid');
        } else {
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->salary;
            $data['month'] = $month;
            $data['year'] = date('Y');
            $data['payment_date'] = date('Y-m-d');
            DB::table('salaries')->insert($data);
        }
    }

    public function allSalary()
    {
        $salaries = DB::table('salaries')->select('month')->groupBy('month')->get();
        //dd($salaries);
        return response()->json($salaries, 200);
    }
    public function salaryView($id)
    {
        $month = $id;
        $view = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->where('salaries.month', $month)->get();
        return response()->json($view);
    }
    public function salaryEdit($id)
    {
        $salaryEdit = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.id','employees.name', 'employees.email', 'salaries.*')
            ->where('salaries.id', $id)->first();
        //dd($salaryEdit);
        return response()->json($salaryEdit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $Salary
     * @return \Illuminate\Http\Response
     */
    public function salaryUpdate(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'employee_id' => 'required',
        //     'amount' => 'required',
        //     'month' => 'required',
        // ]);
        // //Check validation failure
        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'errors' => $validator->errors(),
        //     ], 401);
        // }
        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['month'] = $request->month;
        DB::table('salaries')->where('id',$id)->update($data);
    }

}
