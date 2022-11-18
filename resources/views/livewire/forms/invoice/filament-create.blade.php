<div>
	<form wire:submit.prevent="submit">
		{{ $this->form }}

		<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
			<div>
				<button type="submit" class='btn btn-accent'>Create</button>
				<a href={{ route('revenue.index') }} class="btn">Cancel</a>
			</div>
		</div>
	</form>
</div>
