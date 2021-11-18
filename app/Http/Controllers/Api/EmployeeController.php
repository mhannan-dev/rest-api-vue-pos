<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json([
            'success' => true,
            'message' => 'All employee',
            'data' => $employees,
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
    public function store(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'mobile' => 'required',
            'joining_date' => 'required',
            'image' => 'required',
            'nid' => 'required',
        ]);
        //Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'errors' => $validator->errors(),
            ], 401);
        }
        try {
            if ($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $name = time() . "." . $ext;
                $img = Image::make($request->image)->resize(250, 250);
                $upload_path = 'uploads/employee/';
                $image_url = $upload_path . $name;
                $img->save($image_url);
            }
            //Saving other field to posts table
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->salary = $request->salary;
            $employee->address = $request->address;
            $employee->mobile = $request->mobile;
            $employee->nid = $request->nid;
            $employee->joining_date = date('Y-m-d', strtotime($request->joining_date));
            $employee->image = $image_url;
            $employee->save();
            return response()->json([
                'success' => true,
                'message' => 'Employee Saved successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not saved',
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'mobile' => 'required',
            'joining_date' => 'required',
            'image' => 'required',
            'nid' => 'required',
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
        $data['salary'] = $request->salary;
        $data['joining_date'] = $request->joining_date;
        $data['nid'] = $request->nid;
        $image = $request->newImage;
        //Upload image
        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . "." . $ext;
            $img = Image::make($image)->resize(250, 250);
            $upload_path = 'uploads/employee/';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);
            if ($success) {
                $data['image'] = $image_url;
                $img = DB::table('employees')->where('id', $id)->first();
                $image_path = $img->image;
                $done = unlink($image_path);
                $user = DB::table('employees')->where('id', $id)->update($data);
            }
        } else {
            $oldImage = $request->image;
            $data['image'] = $oldImage;
            $user = DB::table('employees')->where('id', $id)->update($data);
        }
        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $image_path = public_path() . '/' . $employee->image;
            if (!is_null($employee)) {
                $employee->delete();
                unlink($image_path);
                return response()->json([
                    'success' => true,
                    'message' => 'This employee has been deleted',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'This employee not deleted',
            ], 400);
        }
    }
}
