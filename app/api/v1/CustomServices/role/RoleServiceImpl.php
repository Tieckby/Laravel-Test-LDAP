<?php

namespace App\api\v1\CustomServices\role;

use App\Exceptions\api\v1\CustomException;
use App\Http\Requests\api\v1\RoleRequest;
use App\Models\api\v1\Role;
use App\Traits\api\v1\HttpResponse;

class RoleServiceImpl implements RoleService
{
    use HttpResponse;

    public function addNewRole(RoleRequest $request)
    {
        $roleName = $request->validated()['roleName'];
        if ($this->getRoleByName($roleName) == null) {
            Role::create([
                'roleName' => $roleName
            ]);
            return $this->success(null, config('constant_values.addNewRoleMsg'), 201);
        }

        return $this->error(null, config('constant_values.roleNameAlreadyExistsMsg'), 403);
    }

    public function getAllRoles()
    {
        return Role::all();
    }

    public function getRoleByName(string $roleName): ?Role
    {
        $roles = Role::where('roleName', $roleName)->get();

        switch (count($roles)) {
            case 0:
                return null;

            case 1:
                return $roles[0];

            default:
                new CustomException(config('constant_values.duplicatedRoleMsg'), 403);
        }
    }
}
