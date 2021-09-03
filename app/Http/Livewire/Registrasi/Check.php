<?php

namespace App\Http\Livewire\Registrasi;

use Livewire\Component;
use App\Models\User;
use App\Models\Profile;
use App\Models\Userpartner;
use App\Models\TeacherNig;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Check extends Component
{
	public $nig, $register = false;
	public $name, $username, $email, $phone, $gender = 1, $password, $password_confirmation;
	
	public function checking(){
		$this->validate(['nig' => 'required'], ['nig.required' => 'NIG tidak boleh kosong.']);
		
		$check = TeacherNig::where('number', $this->nig)->first();
		
		if(!$check){
			$this->addError('nig', 'Nomor Induk Guru tidak terdaftar.');
		} elseif($check->user_id != null){
			$this->addError('nig', 'NIG yang anda masukkan sudah terdaftar pada akun lain.');
		} else {
			$this->register = true;
		}
	}
	
	public function register(){
		$this->validate([
			'name'	=> 'required',
			'username'	=> 'required|min:4|unique:users',
			'email'	=> 'required|email|unique:users',
			'phone'	=> 'required|min:10|unique:userprofiles',
			'password'	=> 'required|confirmed|min:6'
		],
		[
			'name.required'	=> 'Nama tidak boleh kosong.',
			'username.required'	=> 'Username tidak boleh kosong.',
			'username.min'	=> 'Username minimal 4 karakter.',
			'username.unique'	=> 'Username sudah terdaftar pada akun lain.',
			'email.required'	=> 'Email tidak boleh kosong.',
			'email.email'	=> 'Email tidak valid.',
			'email.unique'	=> 'Email sudah terdaftar pada akun lain.',
			'phone.required'	=> 'Nomor telepon tidak boleh kosong.',
			'phone.min'	=> 'Nomor telepon tidak valid.',
			'phone.unique'	=> 'Nomor telepon sudah terdaftar pada akun lain.',
			'password.required'	=> 'Password tidak boleh kosong.',
			'password.confirmed'	=> 'Konfirmasi password tidak sama.',
			'password.min'	=> 'Password minimal 6 karakter.'
		]);
		$user = User::create([
			'name'	=> $this->name,
			'email'	=> $this->email,
			'username'	=> $this->username,
			'password'	=> Hash::make($this->password),
		]);
		$role = Role::where('name', 'guru')->first();
		$setRole = DB::table('model_has_roles')->insert([
			'role_id' 	=> $role->id,
			'model_type'	=> 'App\User',
			'model_id'	=> $user->id,
		]);
		$teacherNig = TeacherNig::where('number', $this->nig)->update([
			'user_id'	=> $user->id,
		]);
		$user_profile = Profile::create([
			'user_id'	=> $user->id,
			'phone'	=> $this->phone,
			'gender'	=> $this->gender,
		]);
		$user_partner = Userpartner::create([
			'user_id'	=> $user->id,
		]);

		session()->flash('success', 'Registrasi berhasil, silahkan login.');
		return redirect()->route('login');
	}
	
	public function render()
	{
		return view('livewire.registrasi.check');
	}
	
}