<?php

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use App\Http\Controllers\ExcelController;


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
	// USER CLASSROOM
	Route::get('/classroom/index', function(){
		return view('classroom.index', ['id' => Auth::user()->classroom->id, 'classname' => Auth::user()->classroom->name]);
	})->name('classroom.index')->middleware(['role_or_permission:guru|r a guru']);
	Route::get('/classroom/show/{id}', function($id){
		return view('classroom.index', ['id' => $id, 'classname' => '']);
	})->name('classroom.show')->middleware(['permission:r a guru']);
	Route::get('/student/profile/{id}', function($id){ return view('student.show', ['id' => $id]); })->name('student.show');
	Route::get('/student/history/{id}', function($id){ return view('student.show', ['id' => $id]); })->name('student.history');
	// USER HISTORY
	Route::view('/history/attendance', 'teacher.history-attendance')->name('history.attendance')->middleware(['role:guru']);
	Route::view('/history/scoring', 'teacher.history-scoring')->name('history.scoring')->middleware(['role:guru']);
	// USER SETTINGS
	Route::get('/setting/account', [UserProfileController::class, 'show'])->name('profile.show');
	Route::view('/setting/profile', 'profile.show')->name('profile.edit')->middleware(['role:guru']);

	// CLASSROOM
	// Route::middleware([''])
	// Route::view('/classroom', 'classroom.index')->name('classroom.index');
	
	// TEACHERS
	Route::view('/teachers', 'teacher.index')->name('teacher.index');
	Route::view('/teachers/create', 'teacher.create')->name('teacher.create')->middleware(['permission:c a guru']);
	Route::get('/teachers/show/{id}', function($id){ return view('teacher.show', ['id' => $id]); })->name('teacher.show')->middleware(['permission:r a guru']);
	
	// ATTENDANCE
	// GATHERING
	Route::view('/gathering/index', 'attendance.gathering.index')->name('gathering.index')->middleware(['can:r a kumpul']);
	Route::view('/gathering/create', 'attendance.gathering.create')->name('gathering.create')->middleware(['can:c a kumpul']);
	Route::get('/gathering/edit/{id}', function($id){ return view('attendance.gathering.edit', ['id' => $id]); })->name('gathering.edit')->middleware(['can:u a kumpul']);
	Route::get('/gathering/show/{id}', function($id){ return view('attendance.gathering.show', ['id' => $id]); })->name('gathering.show')->middleware(['can:r a kumpul']);
	
	// PERMIT
	Route::view('/permit/index', 'attendance.permit.index')->name('permit.index')->middleware(['can:r a perizinan']);
	Route::view('/permit/create', 'attendance.permit.create')->name('permit.create')->middleware(['can:c a perizinan']);
	Route::get('/permit/edit/{id}', function($id){ return view('attendance.permit.edit', ['id' => $id]); })->name('permit.edit')->middleware(['can:u a perizinan']);
	
	// ASSIGNMENT
	Route::view('/assignment/index', 'attendance.assignment.index')->name('assignment.index')->middleware(['can:r a penugasan']);
	Route::view('/assignment/create', 'attendance.assignment.create')->name('assignment.create')->middleware(['can:c a penugasan']);;
	Route::get('/assignment/edit/{id}', function($id){ return view('attendance.assignment.edit', ['id' => $id]); })->name('assignment.edit')->middleware(['can:u a penugasan']);
	
	// TEACHING
	Route::view('/teaching/index', 'attendance.teaching.index')->name('teaching.index')->middleware(['can:r a absensi']);
	Route::view('/teaching/create', 'attendance.teaching.create')->name('teaching.create')->middleware(['can:c a absensi']);
	Route::get('/teaching/edit/{id}', function($id){ return view('attendance.teaching.edit', ['id' => $id]); })->name('teaching.edit')->middleware(['can:u a absensi']);
	
	// EVALUATION
	Route::view('/evaluation/index', 'attendance.evaluation.index')->name('evaluation.index')->middleware(['can:r a evaluasi']);
	Route::view('/evaluation/create', 'attendance.evaluation.create')->name('evaluation.create')->middleware(['can:c a evaluasi']);
	Route::get('/evaluation/edit/{id}', function($id){ return view('attendance.evaluation.edit', ['id' => $id]); })->name('evaluation.edit')->middleware(['can:u a evaluasi']);
	
	// SCORING
	Route::get('/scoring/index/{id}', function($id){ return view('scoring.index', ['id' => $id]); })->name('scoring.index')->middleware(['can:m a penilaian']);
	Route::get('/scoring/create/{id}', function($id){ return view('scoring.create', ['id' => $id]); })->name('scoring.create')->middleware(['can:c a penilaian']);
	Route::get('/scoring/edit/{id}/{score}/{page}', function($id, $score, $page){ return view('scoring.edit', ['id' => $id, 'score' => $score, 'page' => $page]); })->name('scoring.edit')->middleware(['can:u a penilaian']);
	
	// ATTENDANCE HISTORY
	Route::get('/history/index/{id}', function($id){ return view('teacher.history-index', ['id' => $id]); })->name('teacher.history.index');
	
	Route::group(['middleware' => ['permission:r a excel']], function(){
		Route::get('/excel/index', [ExcelController::class, 'index'])->name('excel.index');
		Route::get('/excel/export/{id}', [ExcelController::class, 'export'])->name('excel.export');
		Route::get('/excel/nilai/{id}', [ExcelController::class, 'nilai'])->name('excel.nilai')->middleware(['permission:m a penilaian']);
	});
	
	Route::group(['middleware' => ['role:developer']], function(){
		Route::get('/permission/index', function(){ return view('developer.permission.index'); })->name('permission.index');
	});
	
	
});