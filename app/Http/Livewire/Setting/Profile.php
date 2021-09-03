<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Profile as Userprofile;

class Profile extends Component
{
	public $user;
	public $profile;
	public $partner;
	public $ftitle, $ltitle, $phone, $gender, $birthplace, $birthdate, $marriage, $address, $ktp, $npwp, $blood, $childnum, $siblings;
	public $nig;
	
	public $marriages = ['Belum Menikah', 'Menikah', 'Bercerai'];

	public $listeners = ['refreshPage' => '$refresh'];
	
	protected function rules() { 
		return [
			'user.name'	=> 'required|string',
			'nig.number'	=> 'required',
			'profile.ftitle'	=> 'nullable',
			'profile.ltitle'	=> 'nullable',
			'profile.ktp'	=> 'required|unique:userprofiles,ktp,' .$this->profile->id,
			'profile.npwp'	=> 'nullable',
			'profile.phone'	=> 'required',
			'profile.gender'	=> 'required',
			'profile.birthplace'	=> 'required',
			'birthdate'	=> 'required|date_format:d/m/Y',
			'profile.childnum'	=> 'nullable',
			'profile.siblings'	=> 'nullable',
			'profile.blood'	=> 'nullable',
			'profile.marriage'	=> 'nullable',
			'profile.address'	=> 'nullable',
		];}
		
		protected $messages = [
			'profile.ktp.required'	=> 'Nomor KTP tidak boleh kosong.',
			'profile.ktp.unique'	=> 'Nomor KTP sudah terdaftar.',
			'profile.phone.required'	=> 'Nomor telepon tidak boleh kosong.',
			'profile.birthplace.required'	=> 'Tempat lahir tidak boleh kosong.',
			'birthdate.required'	=> 'Tanggal lahir tidak boleh kosong.',
			'birthdate.date_format'	=> 'Format penulisan tanggal salah.',
		];
		
		public function mount(){
			$this->nig = $this->user->nig;
			$p = $this->user->profile;
			$this->profile = $p;
			$this->partner = $this->user->partner;
			// 
			$this->birthdate = $p->birthdate ? $p->birthdate->format('d/m/Y') : null;
			
		}
		
		public function render()
		{
			return view('livewire.setting.profile');
		}
		
		public function save(){
			$this->validate();
			// save biodata
			$birthdate = Carbon::createFromFormat('d/m/Y', $this->birthdate)->format('Y-m-d');
			$this->profile->update(['birthdate' => $birthdate]);
			$this->emit('saved');
		}
		
	}