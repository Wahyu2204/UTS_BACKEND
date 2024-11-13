<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    public function index()
    {

        $employees = Employees::all();

        if ($employees) {
            $data = [
                'message' => 'Get all Resource',
                'data' => $employees
            ];

            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Data is Empty'], 200);
        }
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'gender' => 'required',
        'phone' => 'required',
        'address' => 'string|required',
        'email' => 'email|required',
        'status' => 'required',
        'hired_on' => 'required|date',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);
    }

    $employees = Employees::create($request->all());

    return response()->json([
        'message' => 'Employee is created successfully',
        'data' => $employees,
    ], 201);
}

    public function update(Request $request, $id)
    {

        $employees = Employees::find($id);

        if ($employees) {

            $input = [
                'nama' => $request->nama ?? $employees->nama,
                'phone' => $request->phone ?? $employees->nim,
                'email' => $request->email ?? $employees->email,
                'gender' => $request->gender ?? $employees->gender,
                'address' => $request->address ?? $employees->address,
                'status' => $request->status ?? $employees->status,
                'hired_on' => $request->hired_on ?? $employees->hired_on,
            ];

            $employees->update($input);

            $data = [
                'messege' => 'Employe is updated successfully',
                'data' => $employees,
            ];

            return response()->json($data, 200);
        } else {

            return response()->json(['message' => 'Employe is not updated successfully', 404]);
        }
    }

    public function destroy($id)
    {

        $employees = Employees::find($id);

        if ($employees) {

            $employees->delete();

            $data = [
                'messege' => 'Employe is deleted successfully',
            ];

            return response()->json($data, 200);
        } else {

            $data = [
                'messege' => 'Employe not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function show($id)
    {

        $employees = Employees::find($id);

        if ($employees) {

            $data = [
                'messege' => 'Get detail Employees',
                'data' => $employees,
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'messege' => 'Employe not found',
            ];

            return response()->json($data, 404);
        }
    }
}