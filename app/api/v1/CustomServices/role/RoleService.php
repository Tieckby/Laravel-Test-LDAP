<?php

namespace App\api\v1\CustomServices\role;

use App\Http\Requests\api\v1\RoleRequest;
use App\Models\api\v1\Role;

//List of Role functionalities
interface RoleService
{
    public function addNewRole(RoleRequest $request);
    public function getAllRoles();
    public function getRoleByName(string $roleName): ?Role;
}
