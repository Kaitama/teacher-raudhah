<div>

	@livewire('teacher.details.data1', ['teacher' => $teacher], key($teacher->id))
	<x-vertical-spacer />
	
	@if($teacher->partner)
	@livewire('teacher.details.data2', ['teacher' => $teacher], key($teacher->id))
	<x-vertical-spacer />
	@endif
	
	@if($teacher->educations->count() > 0)
	@livewire('teacher.details.data3', ['teacher' => $teacher], key($teacher->id))
	<x-vertical-spacer />
	@endif

	@if($teacher->works->count() > 0)
	@livewire('teacher.details.data4', ['teacher' => $teacher], key($teacher->id))
	<x-vertical-spacer />
	@endif

	@livewire('teacher.details.data5', ['teacher' => $teacher], key($teacher->id))
	<x-vertical-spacer />
	
</div>
