<?php

use App\Http\Controllers\api\v1\DepartmentController;
use App\Http\Controllers\api\v1\EmployeeController;
use App\Http\Controllers\api\v1\RoleController;
use App\Models\api\v1\Employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return view('welcome_v1');
});

/**
 *
 * Routes For Department Ressources
 *
 */
Route::prefix('/department')->group(function () {
    Route::post('/addNew', [DepartmentController::class, 'addNewDepartment']);
    Route::get('/all', [DepartmentController::class, 'getAllDepartments']);
    Route::get('/getByName/{name}', [DepartmentController::class, 'findDepartmentByName']);
});

/**
 *
 * Routes For Role Ressources
 *
 */
Route::prefix('/role')->group(function () {
    Route::post('/addNew', [RoleController::class, 'addNewRole']);
    Route::get('/all', [RoleController::class, 'getAllRoles']);
    Route::get('/getByName/{name}', [RoleController::class, 'getRoleByName']);
});

/**
 *
 * Routes For Employee Ressources
 *
 */
Route::prefix('/employee')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/all', [EmployeeController::class, 'getAllEmployees']);
        Route::get('/getByUsernameOrEmailOrPhoneNumber/{value}', [EmployeeController::class, 'findEmployeeByUsernameOrEmailOrPhoneNumber']);
        Route::post('/addNew', [EmployeeController::class, 'addNewEmployee'])->can('create', Employee::class);
    });

    Route::post('/addNew', [EmployeeController::class, 'addNewEmployee']);
    Route::post('/signin', [EmployeeController::class, 'signinEmployee']);
});
