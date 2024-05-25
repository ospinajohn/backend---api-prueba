<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
  public function getAllEmployees()
  {
    return Employee::all();
  }

  public function createEmployee($data)
  {
    return Employee::create($data);
  }

  public function getEmployeeById($id)
  {
    return Employee::find($id);
  }

  public function updateEmployee($id, $data)
  {
    $employee = Employee::find($id);
    if ($employee) {
      $employee->update($data);
      return $employee;
    }
    return null;
  }

  public function deleteEmployee($id)
  {
    $employee = Employee::find($id);
    if ($employee) {
      return $employee->delete();
    }
    return false;
  }
}
