<?php

namespace App\Http\Livewire\Developer\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
	public $role, $permissions, $role_permission = [], $selected_role;
	public function mount(){
		$this->role = Role::all()->pluck('name');
		$this->permissions = Permission::all()->pluck('name');
	}

	public function render()
	{
		return view('livewire.developer.permission.index');
	}

	public function setPermission(){
		$role = Role::where('name', $this->selected_role)->first();
		$role->syncPermissions($this->role_permission);
		$this->emit('saved');
	}

	public function roleChanged(){
		$role = Role::where('name', $this->selected_role)->first();
		$this->role_permission = $role->getPermissionNames();
	}
}