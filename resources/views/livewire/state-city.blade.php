<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

	<div class="form-control">
		<label for="state_id" class="font-semibold uppercase label">Business Zone (State/District)</label>
		<select wire:model='selectedState' class="select select-primary select-bordered" id="state_id" name="state_id" required>
			<option value="" selected>--choose--</option>
			@foreach ($states as $state)
				<option value="{{ $state->id }}">{{ $state->name }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-control">
		<label for="city_id" class="font-semibold uppercase label">City</label>
		<select wire:model='selectedCity' class="select select-primary select-bordered" id="city_id" name="city_id" required
			{{ !is_null($selectedState) ? '' : 'disabled' }}>
			<option value="" selected>--choose--</option>
			@foreach ($cities as $city)
				<option value="{{ $city->id }}">{{ $city->name }}</option>
			@endforeach
		</select>
	</div>

</div>
