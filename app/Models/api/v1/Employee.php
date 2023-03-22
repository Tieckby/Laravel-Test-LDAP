<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

use App\Models\api\v1\Department;

class Employee extends Authenticatable
{
    use HasFactory, HasApiTokens;

    //Do not create created_at & updated_at column in my table
    public $timestamps = false;

    //The attributes that are mass assignable.
    protected $fillable = [
        'fullName',
        'username',
        'email',
        'phoneNumber',
        'email_verified',
        'password',
        'enabled',

        'department_id'
    ];

    //guarded is The inverse of fillable (Blocking id From Mass Assignment).
    protected $guarded = ['id'];

    //The attributes that should be hidden for serialization.
    protected $hidden = [
        'password'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['department', 'roles'];

    /**
     * The department that belong to the employee.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * The roles that belong to the employee.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_roles');
    }
}
