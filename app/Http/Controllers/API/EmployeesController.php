<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employees\Employee;

use Str;
use Validator;

class EmployeesController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = Employee::with('employee_payslips');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $data = $this->model->orderBy('name')->get();

            return response()->json($data, 200);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => 'unique:employees'
            ]); 

            if ($validator->fails()) {
                return response()->json(
                    'Employee record already exist',
                    400
                );
            }

            $employeeNo = strtoupper('EMPLOYEE-'.Str::random(10));

            $data = $this->model->create([
                'emp_no' => $employeeNo,
                'name' => $request->name,
                'email' => $request->email,
                'contacts' => $request->contacts,
                'address' => $request->address,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
            ]);

            return response()->json($data, 201);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $data = $this->model->findOrFail($id);

            return response()->json($data, 200);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $data = $this->model->findOrFail($id)->update($request->all());
            $updatedData = $this->model->find($id);

            return response()->json($updatedData, 200);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $data = $this->model->findOrFail($id)->delete();

            return response()->json($data, 204);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }
}
