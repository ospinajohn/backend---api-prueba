<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;

    /**
     * EmployeeController constructor.
     *
     * @param EmployeeService $employeeService The employee service instance.
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    
    public function index()
    {
        return response()->json($this->employeeService->getAllEmployees());
    }

    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'razon_social' => 'required|string|max:255',
                'cedula' => 'required|string|max:255|unique:employees,cedula',
                'telefono' => 'required|string|max:255',
                'pais' => 'required|string|max:255',
                'ciudad' => 'required|string|max:255',
            ]);

            $employee = $this->employeeService->createEmployee($validated);
            return response()->json($employee, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $employee = $this->employeeService->getEmployeeById($id);
            if ($employee) {
                return response()->json($employee);
            }
            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'razon_social' => 'required|string|max:255',
                'cedula' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
                'pais' => 'required|string|max:255',
                'ciudad' => 'required|string|max:255',
            ]);

            $employee = $this->employeeService->updateEmployee($id, $validated);
            if ($employee) {
                return response()->json($employee);
            }
            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->employeeService->deleteEmployee($id);
            if ($result) {
                return response()->json(['message' => 'Employee deleted']);
            }
            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
