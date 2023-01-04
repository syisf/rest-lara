<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::latest()->get();
        return response()->json([
            'data' => EmployeeResource::collection($employee),
            'message' => 'Fetch all employee',
            'success' => true
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
        $foto = $request->file('foto');
        $foto->storeAs('public/employee', $foto->hashName());
        $employee = Employee::create([
            'nik' => $request->get('nik'),
            'nama' => $request->get('nama'),
            'alamat' => $request->get('alamat'),
            'telepon' => $request->get('alamat'),
            'alamat' => $request->get('alamat'),
            'foto' => $request->get($foto)
        ]);

        return response()->json([
            'data' => new EmployeeResource($employee),
            'message' => 'Employee created successfully.',
            'success' => true
        ]);
    }

    public function show(Employee $employee)
    {
        return response()->json([
            'data' => new EmployeeResource($employee),
            'message' => 'Data employee found',
            'success' => true
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
            $foto = $request->file('foto');
            $foto->storeAs('public/employee', $foto->hashName());

            $employee->update([
            'nama' => $request->get('nama'),
            'alamat' => $request->get('alamat'),
            'telepon' => $request->get('alamat'),
            'foto' => $request->get($foto)
        ]);

        return response()->json([
            'data' => new EmployeeResource($employee),
            'message' => 'Employee updated successfully',
            'success' => true
        ]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'data' => [],
            'message' => 'Employee deleted successfully',
            'success' => true
        ]);
    }

}
