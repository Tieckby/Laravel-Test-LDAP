<?php

namespace App\api\v1\CustomServices\employee;

use App\Http\Requests\api\v1\EmployeeRequest;
use App\Http\Requests\api\v1\SigninRequest;
use App\Models\api\v1\Employee;

//List of Employee functionalities
interface EmployeeService
{
    public function signinEmployee(SigninRequest $request);
    public function isUsernameOrEmailOrPhoneNumberExists(string $username, string $email, string $phoneNumber): bool;
    public function addNewEmployee(EmployeeRequest $request);
    public function getAllEmployees();
    public function findEmployeeByUsernameOrEmailOrPhoneNumber(string $usernameOrEmailOrPhoneNumber): ?Employee;

    public function addRoleToEmployee(Employee $employee, int $roleId);
    public function removeRoleToEmployee(Employee $employee, int $roleId);
}
