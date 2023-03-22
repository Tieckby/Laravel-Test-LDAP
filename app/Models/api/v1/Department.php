<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\api\v1\Employee;

class Department extends Model
{
    use HasFactory;

    //Do not create created_at & updated_at column in my table
    public $timestamps = false;

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
    ];

    /**
     * Get All Employees For This Department.
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
