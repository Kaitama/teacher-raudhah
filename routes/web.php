<?php

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use App\Http\Controllers\ExcelController;

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
	// return view('welcome');
	return redirect()->route('login');
});

Route::get('/daftar', function(){
	return view('register.index');
})->name('daftar');

Route::prefix('/dashboard')->middleware(['auth:sanctum', 'verified'])->group(function(){
	// DASHBOARD INDEX
	Route::view('/', 'dashboard')->name('dashboard');
	// USER PROFILE SHOW
	Route::view('/profile', 'teacher.profile')->name('dashboard.profile')->middleware(['role:guru']);
	// USER HISTORY
	Route::view('/history/attendance', 'teacher.history-attendance')->name('history.attendance')->middleware(['role:guru']);
	Route::view('/history/scoring', 'teacher.history-scoring')->name('history.scoring')->middleware(['role:guru']);
	// USER SETTINGS
	Route::get('/setting/account', [UserProfileController::class, 'show'])->name('profile.show');
	Route::view('/setting/profile', 'profile.show')->name('profile.edit')->middleware(['role:guru']);
	
	// TEACHERS
	Route::group(['middleware' => ['role:administrator|developer|supervisor']], function(){
		Route::view('/teachers', 'teacher.index')->name('teacher.index');
		Route::view('/teachers/create', 'teacher.create')->name('teacher.create')->middleware(['role:developer|administrator']);
		Route::get('/teachers/show/{id}', function($id){ return view('teacher.show', ['id' => $id]); })->name('teacher.show');
		
		// ATTENDANCE
		// GATHERING
		Route::view('/gathering/index', 'attendance.gathering.index')->name('gathering.index');
		Route::view('/gathering/create', 'attendance.gathering.create')->name('gathering.create')->middleware(['role:developer|administrator']);
		Route::get('/gathering/edit/{id}', function($id){ return view('attendance.gathering.edit', ['id' => $id]); })->name('gathering.edit')->middleware(['role:developer|administrator']);
		Route::get('/gathering/show/{id}', function($id){ return view('attendance.gathering.show', ['id' => $id]); })->name('gathering.show');

		// PERMIT
		Route::view('/permit/index', 'attendance.permit.index')->name('permit.index');
		Route::view('/permit/create', 'attendance.permit.create')->name('permit.create')->middleware(['role:developer|administrator']);
		Route::get('/permit/edit/{id}', function($id){ return view('attendance.permit.edit', ['id' => $id]); })->name('permit.edit')->middleware(['role:developer|administrator']);

		// ASSIGNMENT
		Route::view('/assignment/index', 'attendance.assignment.index')->name('assignment.index');
		Route::view('/assignment/create', 'attendance.assignment.create')->name('assignment.create')->middleware(['role:developer|administrator']);
		Route::get('/assignment/edit/{id}', function($id){ return view('attendance.assignment.edit', ['id' => $id]); })->name('assignment.edit')->middleware(['role:developer|administrator']);

		// TEACHING
		Route::view('/teaching/index', 'attendance.teaching.index')->name('teaching.index');
		Route::view('/teaching/create', 'attendance.teaching.create')->name('teaching.create')->middleware(['role:developer|administrator']);
		Route::get('/teaching/edit/{id}', function($id){ return view('attendance.teaching.edit', ['id' => $id]); })->name('teaching.edit')->middleware(['role:developer|administrator']);
		
		// EVALUATION
		Route::view('/evaluation/index', 'attendance.evaluation.index')->name('evaluation.index');
		Route::view('/evaluation/create', 'attendance.evaluation.create')->name('evaluation.create')->middleware(['role:developer|administrator']);
		Route::get('/evaluation/edit/{id}', function($id){ return view('attendance.evaluation.edit', ['id' => $id]); })->name('evaluation.edit')->middleware(['role:developer|administrator']);

		// SCORING
		Route::get('/scoring/index/{id}', function($id){ return view('scoring.index', ['id' => $id]); })->name('scoring.index');
		Route::get('/scoring/create/{id}', function($id){ return view('scoring.create', ['id' => $id]); })->name('scoring.create')->middleware(['role:developer|administrator']);
		Route::get('/scoring/edit/{id}/{score}/{page}', function($id, $score, $page){ return view('scoring.edit', ['id' => $id, 'score' => $score, 'page' => $page]); })->name('scoring.edit')->middleware(['role:developer|administrator']);
		
		// ATTENDANCE HISTORY
		Route::get('/history/index/{id}', function($id){ return view('teacher.history-index', ['id' => $id]); })->name('teacher.history.index');

		Route::get('/excel/index', [ExcelController::class, 'index'])->name('excel.index')->middleware(['role:developer|administrator|supervisor']);
		Route::get('/excel/export/{id}', [ExcelController::class, 'export'])->name('excel.export')->middleware(['role:developer|administrator|supervisor']);
		Route::get('/excel/nilai/{id}', [ExcelController::class, 'nilai'])->name('excel.nilai')->middleware(['role:developer|administrator|supervisor']);

	});


});