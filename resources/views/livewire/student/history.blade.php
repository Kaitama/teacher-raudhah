<div>
	{{-- tuitions --}}
	@livewire('student.history.tuitions', ['student' => $student], key($student->id))
	
	<x-jet-section-border />
	
	
	{{-- permits --}}
	@livewire('student.history.permits', ['student' => $student], key($student->id))
	
	<x-jet-section-border />
	
	{{-- achievements --}}
	@livewire('student.history.achievements', ['student' => $student], key($student->id))
	
	<x-jet-section-border />
	
	{{-- offenses --}}
	@livewire('student.history.offenses', ['student' => $student], key($student->id))
	
	<x-jet-section-border />
	
	{{-- organizations --}}
	@livewire('student.history.organizations', ['student' => $student], key($student->id))
	
	<x-jet-section-border />
	
	{{-- extracurriculars --}}
	@livewire('student.history.extracurriculars', ['student' => $student], key($student->id))
	
</div>
