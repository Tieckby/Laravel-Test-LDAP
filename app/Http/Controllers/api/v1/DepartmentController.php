<?php

namespace App\Http\Controllers\api\v1;

use App\api\v1\CustomServices\department\DepartmentServiceImpl;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\DepartmentRequest;
use App\Models\api\v1\Department;

class DepartmentController extends Controller
{
    /**
     * The Department Service Impl instance.
     *
     * @var \App\api\v1\CustomServices\department\DepartmentServiceImpl
     */
    protected $departmentServiceImpl;

    /**
     * Create a new controller instance.
     *
     * @param  \App\api\v1\CustomServices\department\DepartmentServiceImpl  $departmentServiceImpl
     * @return void
     */
    public function __construct(DepartmentServiceImpl $departmentServiceImpl)
    {
        $this->departmentServiceImpl = $departmentServiceImpl;
    }

    public function addNewDepartment(DepartmentRequest $request)
    {
        return $this->departmentServiceImpl->addNewDepartment($request);
    }

    public function getAllDepartments()
    {
        return $this->departmentServiceImpl->getAllDepartments();
    }

    public function findDepartmentByName(string $name): ?Department
    {
        return $this->departmentServiceImpl->findDepartmentByName($name);
    }
}
