<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens;
	use HasFactory;
	use HasProfilePhoto;
	use Notifiable;
	use TwoFactorAuthenticatable;
	use HasRoles;
	
	
	protected $dates = ['deleted_at'];
	
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'level',
		'name',
		'username',
		'email',
		'password',
		'deleted_at',
	];
	
	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password',
		'remember_token',
		'two_factor_recovery_codes',
		'two_factor_secret',
	];
	
	/**
	* The attributes that should be cast to native types.
	*
	* @var array
	*/
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
	
	/**
	* The accessors to append to the model's array form.
	*
	* @var array
	*/
	protected $appends = [
		'profile_photo_url',
	];

	public function nig(){
		return $this->hasOne(TeacherNig::class);
	}
	
	public function profile(){
		return $this->hasOne(Profile::class);
	}

	public function partner(){
		return $this->hasOne(Userpartner::class);
	}

	public function childrens(){
		return $this->hasMany(Userchildren::class);
	}

	public function educations(){
		return $this->hasMany(Usereducation::class);
	}

	public function works(){
		return $this->hasMany(Userwork::class);
	}

	public function gatherings(){
		return $this->belongsToMany(Gathering::class);
	}

	public function permits(){
		return $this->hasMany(Userpermit::class);
	}

	public function assignments(){
		return $this->hasMany(Userassignment::class);
	}

	public function teachings(){
		return $this->hasMany(Userteaching::class);
	}

	public function evaluations(){
		return $this->hasMany(Userevaluation::class);
	}

	public function teachingScores(){
		return $this->hasMany(Teachingscore::class);
	}

	public function checkers(){
		return $this->hasMany(Userteaching::class, 'id', 'checked_by');
	}

	public function managementScores(){
		return $this->hasMany(Managementscore::class);
	}
	
	public function classroom(){
		return $this->hasOne(Classroom::class);
	}

}