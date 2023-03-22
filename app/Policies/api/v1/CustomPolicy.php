<?php

namespace App\Policies\api\v1;

use App\api\v1\CustomEnums\DefaultRoles;
use App\Exceptions\api\v1\CustomException;
use App\Models\api\v1\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given employee can create something
     *
     * @param  \App\Models\api\v1\Employee  $employee
     * @return bool
     */
    public function create(Employee $employee)
    {
        foreach($employee->roles as $roles)
        {
            if($roles['roleName'] === DefaultRoles::ADMIN->name || $roles['roleName'] === DefaultRoles::RH_1SIMPLE1->name)
            {
                return true;
            }

            throw new CustomException(config('constant_values.unauthorizedRessourceMsg'), 403);
        }
    }

    /**
     * Determine if the given employee can read something
     *
     * @param  \App\Models\api\v1\Employee  $employee
     * @return bool
     */
    public function read(Employee $employee)
    {
        return false;
    }

    /**
     * Determine if the given employee can update something
     *
     * @param  \App\Models\api\v1\Employee  $employee
     * @return bool
     */
    public function update(Employee $employee)
    {
        return false;
    }

    /**
     * Determine if the given employee can delete something
     *
     * @param  \App\Models\api\v1\Employee  $employee
     * @return bool
     */
    public function delete(Employee $employee)
    {
        return false;
    }
}
