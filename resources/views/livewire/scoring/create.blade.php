<div>
	
	@livewire('scoring.create.management', ['teacher' => $teacher], key($teacher->id))
	<x-jet-section-border />
	
	@livewire('scoring.create.teachery', ['teacher' => $teacher], key($teacher->id))
	<x-jet-section-border />
	
	@livewire('scoring.create.assignment', ['teacher' => $teacher], key($teacher->id))
	
	
	
	
	
	
</div>
