<x-jet-form-section submit="setPermission">
	<x-slot name="title">{{ __('Assign Permission') }}</x-slot>
	<x-slot name="description">
		{{ __('Set permission to selected role.') }}
	</x-slot>
	
	<x-slot name="form">
		<div class="col-span-3">
			<x-jet-label for="role">{{ __('Select Role') }}</x-jet-label>
			<x-select wire:model="selected_role" wire:change="roleChanged" class="block w-full">
				@foreach ($role as $r)
				<option value="{{ $r }}">{{ ucwords($r) }}</option>
				@endforeach
			</x-select>
		</div>
		<!-- Start Date -->
		<div class="col-span-6">
			<x-jet-label for="permissions">{{ __('Select Permissions') }}</x-jet-label>
			<div class="grid grid-cols-4 gap-4">
				@foreach ($permissions as $p)
				
				<div class="flex items-start">
					<div class="flex items-center h-5">
						<input id="{{ $p }}" wire:model="role_permission" value="{{ $p }}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
					</div>
					<div class="ml-3 text-sm">
						<label for="{{ $p }}" class="font-medium text-gray-700">{{ ucwords($p) }}</label>
					</div>
				</div>
				
				@endforeach
			</div>
			<x-jet-input-error for="permissions" class="mt-2" />
		</div>
		
	</x-slot>
	<x-slot name="actions">
		<x-jet-action-message class="mr-3" on="saved">
			{{ __('Sukes.') }}
		</x-jet-action-message>
		<x-jet-button wire:loading.attr="disabled">
			{{ __('Set Permission') }}
		</x-jet-button>
	</x-slot>
</x-jet-form-section>