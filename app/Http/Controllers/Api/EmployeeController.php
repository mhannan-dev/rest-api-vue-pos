<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderby('id', 'desc')->get();
        return response()->json([
            'title' => "All Employee",
            'message' => "All employee",
            'data' => $employees,
        ]);
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
        if ($request->isMethod('post')) {
            $data = $request->all();
            // $validateData = $request->validate([
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|email|unique:employees',
            //     'salary' => 'required|numeric',
            //     'mobile' => 'required|mobile|unique:employees',
            //     'address' => 'required',
            //     'nid' => 'required|nid|unique:employees',
            //     'joining_date' => 'required',
            //     'image' => 'required|image|max:1024',
            // ]);
            try {
                if ($request->image) {
                    $position = strpos($request->image, ';');
                    $sub = substr($request->image, 0, $position);
                    $ext = explode('/', $sub)[1];
                    $name = time() . "." . $ext;
                    $img = Image::make($request->image)->resize(250, 250);
                    $upload_path = 'uploads/employee/';
                    $image_url  = $upload_path . $name;
                    $img->save($image_url);
                    //Saving other field to posts table
                    $employee->name = $data['name'];
                    $employee->email = $data['email'];
                    $employee->salary = $data['salary'];
                    $employee->address = $data['address'];
                    $employee->mobile = $data['mobile'];
                    $employee->nid = $data['nid'];
                    $employee->joining_date = date('Y-m-d', strtotime($request->joining_date));
                    $employee->image = $image_url;
                    $employee->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Employee Saved successfully',
                    ], 200);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee Saved successfully',
                ], 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
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
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
