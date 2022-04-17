<div>
    @livewire('scoring.index.teachery', ['teacher' => $teacher], key($teacher->id))

		<x-jet-section-border />

		@livewire('scoring.index.management', ['teacher' => $teacher], key($teacher->id))

		<x-jet-section-border />

		@livewire('scoring.index.assignment', ['teacher' => $teacher], key($teacher->id))

</div>
