<?php

namespace App\api\v1\CustomServices\department;

use App\Http\Requests\api\v1\DepartmentRequest;
use App\Models\api\v1\Department;

//List of Department functionalities
interface DepartmentService
{
    public function addNewDepartment(DepartmentRequest $request);
    public function getAllDepartments();
    public function findDepartmentByName(string $name): ?Department;
}
