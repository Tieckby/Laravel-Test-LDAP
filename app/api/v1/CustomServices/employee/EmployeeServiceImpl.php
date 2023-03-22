<?php

namespace App\api\v1\CustomServices\employee;

use App\api\v1\CustomServices\employee\EmployeeService;
use App\Exceptions\api\v1\CustomException;
use App\Traits\api\v1\HttpResponse;

use App\Http\Requests\api\v1\EmployeeRequest;
use App\Http\Requests\api\v1\SigninRequest;
use App\Models\api\v1\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeServiceImpl implements EmployeeService
{
    use HttpResponse;

    //Sign In An Employee
    public function signinEmployee(SigninRequest $request)
    {
        $validatedData = $request->validated();
        $identifier = $validatedData['usernameOrEmailOrPhoneNumber'];
        $password = $validatedData['password'];

        //Check Username Or Email Or PhoneNumber
        $employee = $this->findEmployeeByUsernameOrEmailOrPhoneNumber($identifier);

        //Check if employee exists with this correspond password
        if (!$employee || !Hash::check($password, $employee->password)) {
            throw new CustomException(config('constant_values.employeeAuthInvalidMsg'), 401);
        }

        $employee->tokens()->delete();
        return $this->success([
            'roles' => $employee->roles,
            'token' => $employee->createToken($identifier)->plainTextToken
        ], config('constant_values.employeeAuthValidMsg'));
    }

    //Check if employee username or email or phoneNumber exists
    public function isUsernameOrEmailOrPhoneNumberExists(string $username, string $email, string $phoneNumber): bool
    {
        $isUsernameExists = $this->findEmployeeByUsernameOrEmailOrPhoneNumber($username);
        $isEmailExists = $this->findEmployeeByUsernameOrEmailOrPhoneNumber($email);
        $isPhoneNumberExists = $this->findEmployeeByUsernameOrEmailOrPhoneNumber($phoneNumber);

        return $isUsernameExists != null || $isEmailExists != null || $isPhoneNumberExists != null;
    }

    //Add New Employee
    public function addNewEmployee(EmployeeRequest $request)
    {
        $validatedData = $request->validated();

        $isEmployeeExists = $this->isUsernameOrEmailOrPhoneNumberExists($validatedData['username'], $validatedData['email'], $validatedData['phoneNumber']);

        if (!$isEmployeeExists) {
            $result = Employee::create([
                'fullName' => $validatedData['fullName'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'phoneNumber' => $validatedData['phoneNumber'],
                'password' => Hash::make($validatedData['password']),
                'email_verified' => $validatedData['email_verified'],
                'department_id' => $validatedData['department_id']
            ]);

            $this->addRoleToEmployee($result, $validatedData['role_id']);
            return $this->success(null, config('constant_values.addNewEmployeeMsg'), 201);
        }

        return $this->error(null, config('constant_values.employeeAlreadyExistsMsg'), 403);
    }

    //Get All Employees
    public function getAllEmployees()
    {
        return Employee::all();
    }

    //Get Employee By Username Or Email Or PhoneNumber
    public function findEmployeeByUsernameOrEmailOrPhoneNumber(string $usernameOrEmailOrPhoneNumber): ?Employee
    {

        $employees = Employee::where('username', $usernameOrEmailOrPhoneNumber)
                            ->orWhere('email', $usernameOrEmailOrPhoneNumber)
                            ->orWhere('phoneNumber', $usernameOrEmailOrPhoneNumber)->get();

        switch (count($employees)) {
            case 0:
                return null;

            case 1:
                return $employees[0];

            default:
                new CustomException(config('constant_values.duplicatedEmployeeMsg'), 403);
        }
    }

    /**
     * Add Role To Employee
     *
     * The attach method to attach a role to a user
     *
     * By inserting a record in the relationship's intermediate table
     *
     */
    public function addRoleToEmployee(Employee $employee, int $roleId)
    {
        $employee->roles()->attach($roleId);
    }

    /**
     * Remove Role To Employee
     *
     * The detach method will delete the appropriate record out of the intermediate table,
     *
     * However, both models will remain in the database
     *
     */
    public function removeRoleToEmployee(Employee $employee, int $roleId)
    {
        $employee->roles()->detach($roleId);
    }
}
