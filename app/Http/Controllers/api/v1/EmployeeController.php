<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;

use App\Http\Requests\api\v1\EmployeeRequest;
use App\Http\Requests\api\v1\SigninRequest;
use App\api\v1\CustomServices\employee\EmployeeServiceImpl;
use App\Models\api\v1\Employee;

class EmployeeController extends Controller
{
    /**
     * The Employee Service Impl instance.
     *
     * @var \App\api\v1\CustomServices\employee\EmployeeServiceImpl
     */
    protected $employeeServiceImpl;

    /**
     * Create a new controller instance.
     *
     * @param  \App\api\v1\CustomServices\employee\EmployeeServiceImpl  $employeeServiceImpl
     * @return void
     */
    public function __construct(EmployeeServiceImpl $employeeServiceImpl)
    {
        $this->employeeServiceImpl = $employeeServiceImpl;
    }

    public function signinEmployee(SigninRequest $request)
    {
        return $this->employeeServiceImpl->signinEmployee($request);
    }

    public function addNewEmployee(EmployeeRequest $request){
        return $this->employeeServiceImpl->addNewEmployee($request);
    }

    public function getAllEmployees()
    {
        return $this->employeeServiceImpl->getAllEmployees();
    }

    public function findEmployeeByUsernameOrEmailOrPhoneNumber(string $usernameOrEmailOrPhoneNumber): ?Employee
    {
        return $this->employeeServiceImpl->findEmployeeByUsernameOrEmailOrPhoneNumber($usernameOrEmailOrPhoneNumber);
    }

}
