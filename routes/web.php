<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AssignProgramController;
use App\Http\Controllers\Admin\AssignUserController;
use App\Http\Controllers\user\DataEntryController;
use App\Http\Controllers\userAdmin\AssignTestController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['superadmin']], function () {
    Route::get('user-register', function () {
        return view('admin.register');
    });

    Route::get('user-register', [App\Http\Controllers\Admin\DashboardController::class, 'registered']);
    Route::get('/user-edit/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'registeredit']);
    Route::put('/user-register-update/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'registerupdate']);
    Route::delete('/user-delete/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'registerdelete']);

    Route::get('/labs', [App\Http\Controllers\Admin\LabsController::class, 'index']);
    Route::post('/save-labs', [App\Http\Controllers\Admin\LabsController::class, 'store']);
    Route::get('/labs/{id}', [App\Http\Controllers\Admin\LabsController::class, 'edit']);
    Route::put('/labs-update/{id}', [App\Http\Controllers\Admin\LabsController::class, 'update']);
    Route::delete('labs-delete/{id}', [App\Http\Controllers\Admin\LabsController::class, 'delete']);

    Route::get('/departments', [App\Http\Controllers\Admin\DepartmentController::class, 'index']);
    Route::post('/save-departments', [App\Http\Controllers\Admin\DepartmentController::class, 'store']);
    Route::get('/departments/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'edit']);
    Route::put('/departments-update/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'update']);
    Route::delete('departments-delete/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'delete']);

    Route::get('/programs', [App\Http\Controllers\Admin\ProgramController::class, 'index']);
    Route::post('/save-programs', [App\Http\Controllers\Admin\ProgramController::class, 'store']);
    Route::get('/programs/{id}', [App\Http\Controllers\Admin\ProgramController::class, 'edit']);
    Route::put('/programs-update/{id}', [App\Http\Controllers\Admin\ProgramController::class, 'update']);
    Route::delete('programs-delete/{id}', [App\Http\Controllers\Admin\ProgramController::class, 'delete']);

    Route::get('/reagents', [App\Http\Controllers\Admin\ReagentController::class, 'index']);
    Route::post('/save-reagents', [App\Http\Controllers\Admin\ReagentController::class, 'store']);
    Route::get('/reagents/{id}', [App\Http\Controllers\Admin\ReagentController::class, 'edit']);
    Route::put('/reagents-update/{id}', [App\Http\Controllers\Admin\ReagentController::class, 'update']);
    Route::delete('reagents-delete/{id}', [App\Http\Controllers\Admin\ReagentController::class, 'delete']);

    Route::get('/methods', [App\Http\Controllers\Admin\MethodController::class, 'index']);
    Route::post('/save-methods', [App\Http\Controllers\Admin\MethodController::class, 'store']);
    Route::get('/methods/{id}', [App\Http\Controllers\Admin\MethodController::class, 'edit']);
    Route::put('/methods-update/{id}', [App\Http\Controllers\Admin\MethodController::class, 'update']);
    Route::delete('methods-delete/{id}', [App\Http\Controllers\Admin\MethodController::class, 'delete']);

    Route::get('/units', [App\Http\Controllers\Admin\UnitController::class, 'index']);
    Route::post('/save-units', [App\Http\Controllers\Admin\UnitController::class, 'store']);
    Route::get('/units/{id}', [App\Http\Controllers\Admin\UnitController::class, 'edit']);
    Route::put('/units-update/{id}', [App\Http\Controllers\Admin\UnitController::class, 'update']);
    Route::delete('units-delete/{id}', [App\Http\Controllers\Admin\UnitController::class, 'delete']);

    Route::get('/instruments', [App\Http\Controllers\Admin\InstrumentController::class, 'index']);
    Route::post('/save-instruments', [App\Http\Controllers\Admin\InstrumentController::class, 'store']);
    Route::get('/instruments/{id}', [App\Http\Controllers\Admin\InstrumentController::class, 'edit']);
    Route::put('/instruments-update/{id}', [App\Http\Controllers\Admin\InstrumentController::class, 'update']);
    Route::delete('instruments-delete/{id}', [App\Http\Controllers\Admin\InstrumentController::class, 'delete']);

    Route::get('/tests', [App\Http\Controllers\Admin\TestController::class, 'index']);
    Route::post('/save-tests', [App\Http\Controllers\Admin\TestController::class, 'store']);
    Route::get('/tests/{testcode}', [App\Http\Controllers\Admin\TestController::class, 'edit']);
    Route::put('/tests-update/{testcode}', [App\Http\Controllers\Admin\TestController::class, 'update']);
    Route::delete('tests-delete/{testcode}', [App\Http\Controllers\Admin\TestController::class, 'delete']);

    Route::get('/methods', [App\Http\Controllers\Admin\MethodController::class, 'index']);
    Route::post('/save-methods', [App\Http\Controllers\Admin\MethodController::class, 'store']);
    Route::get('/methods/{id}', [App\Http\Controllers\Admin\MethodController::class, 'edit']);
    Route::put('/methods-update/{id}', [App\Http\Controllers\Admin\MethodController::class, 'update']);
    Route::delete('methods-delete/{id}', [App\Http\Controllers\Admin\MethodController::class, 'delete']);

    Route::get('/assign-programs', [AssignProgramController::class, 'index'])->name('assign.programs');
    Route::post('/save-assign-programs', [AssignProgramController::class, 'store']);
    Route::get('/assign-programs/{id}', [AssignProgramController::class, 'edit']);
    Route::put('/assign-programs-update/{id}', [AssignProgramController::class, 'update']);
    Route::delete('/assign-programs-delete/{id}', [AssignProgramController::class, 'delete']);

    Route::get('/assign-users', [AssignUserController::class, 'index'])->name('assign.users');
    Route::post('/save-assign-users', [AssignUserController::class, 'store']);
    Route::get('/assign-users/{id}', [AssignUserController::class, 'edit']);
    Route::put('/assign-users-update/{id}', [AssignUserController::class, 'update']);
    Route::delete('/assign-users-delete/{id}', [AssignUserController::class, 'delete']);

});

Route::group(['middleware' => ['admin']], function () {
    Route::get('assign-tests', function () {
        return view('useradmin.assign-tests');
    });

    Route::get('assign-tests', [AssignTestController::class, 'index']);
    Route::post('/save-assign-tests', [AssignTestController::class, 'store']);
    Route::get('/assign-tests/{id}', [AssignTestController::class, 'edit']);
    Route::put('/assign-tests-update/{id}', [AssignTestController::class, 'update']);
    Route::delete('/assign-tests-delete/{id}', [AssignTestController::class, 'delete']);

});

Route::group(['middleware' => ['user']], function () {
    Route::get('entry-results', function () {
        return view('user.entry-results');
    });

    Route::get('entry-results', [DataEntryController::class, 'index']);
    Route::post('/save-entry-results', [DataEntryController::class, 'store']);
    Route::get('/entry-results/{id}', [DataEntryController::class, 'edit']);
    Route::put('/entry-results-update/{id}', [DataEntryController::class, 'update']);
    Route::delete('/entry-results-delete/{id}', [DataEntryController::class, 'delete']);

});
