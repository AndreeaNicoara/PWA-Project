<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('dashboard', function () {
        return response()->json(['data' => 'Test Data']);
    });
});



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    // Route::post('login', 'AuthController@login');
    Route::post('login', 'system\auth\AuthController@loginAuthentication');
    Route::post('/signup-process', 'system\auth\AuthController@signupProcess');


    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
   

});

Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'front'

], function ($router) {

    Route::post('me', 'AuthController@me');
    Route::get('myself', 'system\auth\AuthController@myself');


    Route::post('/dashboard', 'system\main\DashboardController@index');

    //****User Management Routes****//
    Route::get('/manage/user', 'system\user\UserController@index');
    Route::post('/add-user-form-ajax', 'system\user\UserController@addUserFormAjax');
    Route::post('/add-user-process', 'system\user\UserController@addUserProcess');
    Route::post('/edit-user-form', 'system\user\UserController@editUserForm');
    Route::post('/update-user-process', 'system\user\UserController@updateUserProcess');
    Route::post('/delete-user-process', 'system\user\UserController@deleteUserProcess');


    //****Project Management Routes****//
    Route::get('/manage/project', 'system\project\ProjectController@index');
    Route::post('/add-project-form-ajax', 'system\project\ProjectController@addProjectFormAjax');
    Route::post('/add-project-process', 'system\project\ProjectController@addProjectProcess');
    Route::post('/edit-project-form-ajax', 'system\project\ProjectController@editProjectFormAjax');
    Route::post('/update-project-process', 'system\project\ProjectController@updateProjectProcess');
    Route::post('/delete-project-process', 'system\project\ProjectController@deleteProjectProcess');
    Route::post('/get-project-member-list', 'system\project\ProjectController@getProjectMemberList');
    Route::get('/project/assign-task/{project_task_id}', 'system\project\ProjectController@assignTask');
    Route::post('/project/assign-user-form-ajax', 'system\project\ProjectController@assignUserFormAjax');
    Route::post('/project/update-task-user-process', 'system\project\ProjectController@updateTaskUserProcess');

    Route::get('/manage/task', 'system\task\TaskController@index');
    Route::post('/edit-task-form-ajax', 'system\task\TaskController@editTaskFormAjax');
    Route::post('/update-task-process', 'system\task\TaskController@updateTaskProcess');

    //****Role Management Routes****//
    Route::get('/manage/role', 'system\role\RoleController@index');
    Route::post('/view-role-form-ajax', 'system\role\RoleController@viewRoleFormAjax');

    //****Leader Management Routes****//
    Route::get('/manage/leader', [App\Http\Controllers\system\leader\LeaderConroller::class, 'index']);
    Route::post('/add-leader-form-ajax', [App\Http\Controllers\system\leader\LeaderConroller::class, 'addLeaderFormAjax']);
    Route::post('/add-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'addLeaderProcess']);
    Route::post('/update-leader-form-ajax', [App\Http\Controllers\system\leader\LeaderConroller::class, 'updateLeaderFormAjax']);
    Route::post('/update-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'updateLeaderProcess']);
    Route::post('/delete-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'deleteLeaderProcess']);

});
