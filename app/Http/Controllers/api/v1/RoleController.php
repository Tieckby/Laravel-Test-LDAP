<?php

namespace App\Http\Controllers\api\v1;

use App\api\v1\CustomServices\role\RoleServiceImpl;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\RoleRequest;
use App\Models\api\v1\Role;

class RoleController extends Controller
{
    /**
     * The Role Service Impl instance.
     *
     * @var \App\api\v1\CustomServices\role\RoleServiceImpl
     */
    protected $roleServiceImpl;

    /**
     * Create a new controller instance.
     *
     * @param  \App\api\v1\CustomServices\role\RoleServiceImpl  $roleServiceImpl
     * @return void
     */
    public function __construct(RoleServiceImpl $roleServiceImpl)
    {
        $this->roleServiceImpl = $roleServiceImpl;
    }

    public function addNewRole(RoleRequest $request)
    {
        return $this->roleServiceImpl->addNewRole($request);
    }

    public function getAllRoles()
    {
        return $this->roleServiceImpl->getAllRoles();
    }

    public function getRoleByName(string $roleName): ?Role
    {
        return $this->roleServiceImpl->getRoleByName($roleName);
    }

}
