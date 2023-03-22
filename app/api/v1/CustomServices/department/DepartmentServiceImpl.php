<?php

namespace App\api\v1\CustomServices\department;

use App\Exceptions\api\v1\CustomException;
use App\Http\Requests\api\v1\DepartmentRequest;
use App\Models\api\v1\Department;
use App\Traits\api\v1\HttpResponse;

class DepartmentServiceImpl implements DepartmentService
{
    use HttpResponse;

    public function addNewDepartment(DepartmentRequest $request)
    {
        $validatedData = $request->validated();
        $isDepartmentExists = $this->findDepartmentByName($request->name);

        if ($isDepartmentExists == null) {
            Department::create($validatedData);
            return $this->success(null, config('constant_values.addNewDepartmentMsg'), 201);
        }

        return $this->error(null, config('constant_values.departmentNameAlreadyExistsMsg'), 403);
    }

    public function getAllDepartments()
    {
        return Department::all();
    }

    public function findDepartmentByName(string $name): ?Department
    {
        $departments = Department::where('name', $name)->get();

        switch (count($departments)) {
            case 0:
                return null;

            case 1:
                return $departments[0];

            default:
                new CustomException(config('constant_values.duplicatedDepartmentMsg'), 403);
        }
    }
}
