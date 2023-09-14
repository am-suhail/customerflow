<form wire:submit.prevent="submit">
					@csrf

					<div class="mt-8 mb-4 divider">COMPANY DETAILS</div>
	<div class="grid grid-cols-2 mt-4 gap-4">
    <div class="form-control">
        <label for="company_id" class="font-semibold uppercase label">Company</label>
        <select wire:model='company_id' class="select select-primary select-bordered" id="company_id" name="company_id" required>
            <option value="" selected>--choose company--</option>
            @foreach ($companies as $id => $name)
                <option value="{{ $id }}" style="font-size:20px">{{ $name }}</option>
            @endforeach
        </select>
        @error('company_id')
            <label class="label">
                <span class="text-red-600 label-text-alt">{{ $message }}</span>
            </label>
        @enderror
    </div>

    <div class="form-control">
        <label for="branch_id" class="font-semibold uppercase label">Branch</label>
        <select wire:model='branch_id' class="select select-primary select-bordered" id="branch_id" name="branch_id" required>
            <option value="" selected>--choose branch--</option>
            @foreach ($branches as $id => $branch)
                <option value="{{ $id }}" style="font-size:20px" {{ is_null($company_id) ? 'disabled' : '' }}>{{ $branch }}</option>
            @endforeach
        </select>
        @error('branch_id')
            <label class="label">
                <span class="text-red-600 label-text-alt">{{ $message }}</span>
            </label>
        @enderror
    </div>
</div>

 <div class="grid grid-cols-2 mt-4 gap-4">
		<div class="form-control">
		{!! Form::label('date', 'Date', ['class' => 'label font-semibold uppercase']) !!}
		{!! Form::date('date', old('date'), [
		 'class' => 'input input-bordered input-primary' . ($errors->has('date') ? 'border-2 border-red-600' : ''),
         'wire:model'=>'date',
		]) !!}
		@error('date')
		<label class="label">
		<span class="text-red-600 label-text-alt">{{ $message }}</span>
		</label>
		@enderror
	</div>

	<div class="form-control">
            {!! Form::label('invoices', 'Invoices', ['class' => 'label font-semibold uppercase']) !!}
               {!! Form::number('invoices', old('invoices'), [
                 'class' => 'input input-bordered input-primary' . ($errors->has('invoices') ? 'border-2 border-red-600' : ''),
                 'wire:model'=>'invoices',
              ]) !!}
            @error('invoices')
              <label class="label">
                <span class="text-red-600 label-text-alt">{{ $message }}</span>
             </label>
          @enderror
        </div>
     </div>	

     <div class="grid grid-cols-2 mt-4 gap-4">			
     <div class="form-control">
     {!! Form::label('loyalty_cards', 'Loyalty Cards', ['class' => 'label font-semibold uppercase']) !!}
			{!! Form::number('loyalty_cards', old('loyalty_cards'), [
	   'class' => 'input input-bordered input-primary' . ($errors->has('loyalty_cards') ? 'border-2 border-red-600' : ''),
	'wire:model'=>'loyalty_cards',
    
     ] ) !!}
			@error('loyalty_cards')
			    <label class="label">
					<span class="text-red-600 label-text-alt">{{ $message }}</span>
				</label>
		    @enderror
		</div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 mt-4">
						<div class="form-control">
							{!! Form::label('remark', 'Remark', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::textarea('remark', old('remark'), [
							    'class' => 'textarea textarea-bordered	textarea-primary' . ($errors->has('remark') ? 'border-2 border-red-600' : ''),
                                'wire:model'=>'remark',
							]) !!}
							@error('remark')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
			</div>

					<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4 md:w-1/2'>
						<button type="submit" class='btn btn-accent'>Create</button>
						<a href={{ route ('customer-flow.index') }} class="btn">Cancel</a>
					</div>
				</form>
        </div>
    </div>											
					
					

			

					