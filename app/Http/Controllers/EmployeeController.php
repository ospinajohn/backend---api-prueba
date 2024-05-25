<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;

    /**
     * EmployeeController constructor una instancia de EmployeeService.
     *
     * @param EmployeeService $employeeService La instancia del servicio de empleados. 
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }


    public function index()
    {
        /**
         * Recupera todos los empleados y devuelve una respuesta JSON. Llama al método getAllEmployees del servicio de empleados.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        return response()->json($this->employeeService->getAllEmployees());
    }

    public function store(Request $request)
    {

        try {
            /**
             * Crear un nuevo empleado. Valida los datos de la solicitud y llama al método createEmployee del servicio de empleados.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\JsonResponse
             */
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
            /**
             * Recuperar un empleado por ID. Llama al método getEmployeeById del servicio de empleados y valida si el empleado existe. Devuelve una respuesta JSON.
             *
             * @param int $id El ID del empleado a recuperar.
             * @return \Illuminate\Http\JsonResponse La respuesta JSON que contiene los datos del empleado.
             */
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
            /**
             * Actualizar un registro de empleado. Valida los datos de la solicitud y llama al método updateEmployee del servicio de empleados.
             *
             * @param  \Illuminate\Http\Request  $request
             * @param  int  $id
             * @return \Illuminate\Http\JsonResponse
             */
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
            /**
             * Elimina a un empleado.
             *
             * @param int $id El ID del empleado a eliminar.
             * @return \Illuminate\Http\JsonResponse La respuesta JSON que indica el éxito o el fracaso de la eliminación.
             */
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
