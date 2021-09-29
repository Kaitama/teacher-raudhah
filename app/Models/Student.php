<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

		protected $dates = ['birthdate'];

		public function classroom(){
			return $this->belongsTo(Classroom::class);
		}

		public function dormroom(){
			return $this->belongsTo(Dormroom::class);
		}

		public function profile(){
			return $this->hasOne(StudentProfile::class);
		}

		// relation to tuition
	public function tuitions()
	{
		return $this->hasMany(StudentTuition::class);
	}
	
	// relation to achievement
	public function achievements()
	{
		return $this->hasMany(StudentAchievement::class);
	}
	
	// relation to offense
	public function offenses()
	{
		return $this->hasMany(StudentOffense::class);
	}
	
	// relation to permit
	public function permits()
	{
		return $this->hasMany(StudentPermit::class);
	}
	
	// relation to user
	public function parent()
	{
		return $this->belongsTo(User::class);
	}
	
	// relation to organization
	public function organizations()
	{
		return $this->belongsToMany(StudentOrganization::class, 'organization_student', 'student_id', 'organization_id')
		->withTimestamps()
		->withPivot(['position', 'description', 'joindate', 'outdate', 'isactive'])
		->as('organization_student');
	}

	// relation to extracurricular
	public function extracurriculars()
	{
		return $this->belongsToMany(StudentExtracurricular::class, 'extracurricular_student', 'student_id', 'extracurricular_id')
		->withPivot(['joindate', 'outdate', 'isactive'])
		->as('extracurricular_student');
	}
}