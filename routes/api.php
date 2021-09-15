<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseRegisterController;
use App\Http\Controllers\StudentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/register-student', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login'])->name('login');
    Route::get('profile', [AuthController::class,'profile']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class,'logout']);

});

/*------------------------------------------------------------------------
| Route for student controller
--------------------------------------------------------------------------*/

Route::get('/get-students/{id?}',[StudentController::class,'index']);
Route::put('/student-update',[StudentController::class,'update']);

/*------------------------------------------------------------------------
| Route for Course controller
--------------------------------------------------------------------------*/

Route::post('/course-create',[CourseController::class,'create']);
Route::get('/get-courses',[CourseController::class,'index']);
Route::delete('/delete-course/{id}',[CourseController::class,'delete']);

/*------------------------------------------------------------------------
| Route for Course Register controller
--------------------------------------------------------------------------*/

Route::post('/course-register',[CourseRegisterController::class,'create']);
Route::delete('/drop-course/{id}',[CourseRegisterController::class,'drop']);
Route::get('get-student-course',[CourseRegisterController::class,'student_course']);

/*------------------------------------------------------------------------
| Note : Every user's or student's password is : 123456
--------------------------------------------------------------------------*/
