<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
  public function getAllEmployees()
  {
    return Employee::all(); // Devuelve todos los empleados.
  }

  public function createEmployee($data)
  {
    return Employee::create($data); // Crea un nuevo empleado.
  }

  public function getEmployeeById($id)
  {
    return Employee::find($id); // Devuelve un empleado por su ID.
  }

  public function updateEmployee($id, $data)
  {
    /**
     * Actualizar un registro de empleado en la base de datos.
     *
     * @param int $id El ID del empleado a actualizar.
     * @param array $data Los datos con los que actualizar al empleado.
     * @return Employee|null El registro actualizado del empleado, o null si no se ha encontrado el empleado.
     */
    $employee = Employee::find($id);
    if ($employee) {
      $employee->update($data);
      return $employee;
    }
    return null;
  }

  public function deleteEmployee($id)
  {
    /**
     * Borrar un empleado por ID.
     *
     * @param int $id El ID del empleado a eliminar.
     * @return bool True si el empleado se ha eliminado correctamente, false en caso contrario.
     */
    $employee = Employee::find($id);
    if ($employee) {
      return $employee->delete();
    }
    return false;
  }
}
