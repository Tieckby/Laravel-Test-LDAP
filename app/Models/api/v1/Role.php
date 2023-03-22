<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //Do not create created_at & updated_at column in my table
    public $timestamps = false;

    //The attributes that are mass assignable.
    protected $fillable = [
        'roleName',
    ];

    //guarded is The inverse of fillable (Blocking id From Mass Assignment).
    protected $guarded = ['id'];

    /**
     * The employees that belong to the role.
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
