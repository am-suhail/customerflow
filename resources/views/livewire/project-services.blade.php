<div>
    <div class="mb-2">
        @foreach($services as $i => $service)
        <div class="flex flex-wrap p-4 my-4 border rounded bg-base-200">
            <div class="flex w-full mb-2">
                <div class="flex-1 form-control">
                    <select name="services[{{ $i }}][service_id]" class="select select-bordered select-primary">
                        <option value="">--choose--</option>
                        @foreach ($this->service_lists as $service_item)
                        <option value="{{ $service_item->id }}"
                            {{ ($service_item->id == $service['service_id'] ? 'selected' : '' ) }}>
                            {{ $service_item->code }} | {{ Str::limit($service_item->name, 80) }}
                        </option>
                        @endforeach
                    </select>
                    @error("services.{$i}.service_id")
                    <div class="label">
                        <span class="text-error label-text">
                            {{ $errors->first("services.{$i}.service_id") }}
                        </span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="flex w-full gap-4">
                <div class="flex-1 form-control">
                    <label class="label">Quantity</label>
                    <input value="{{ $service['qty'] }}" placeholder="Service Quantity" type="number"
                        name="services[{{ $i }}][qty]" class="input input-bordered input-primary">
                    @error("services.{$i}.qty")
                    <div class="label">
                        <span class="text-error label-text">
                            {{ $errors->first("services.{$i}.qty") }}
                        </span>
                    </div>
                    @enderror
                </div>

                <div class="flex-1 form-control">
                    <label class="label">Price</label>
                    <input value="{{ $service['price'] }}" placeholder="Service Price" type="number" step=".01"
                        name="services[{{ $i }}][price]" class="input input-bordered input-primary">
                    @error("services.{$i}.price")
                    <div class="label">
                        <span class="text-error label-text">
                            {{ $errors->first("services.{$i}.price") }}
                        </span>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <button wire:click.prevent="addService" class="btn btn-accent btn-sm">
        Add Service
    </button>

    @if (count($services) > 0)
    <button wire:click.prevent="removeService({{ $i ?? 0 }})" class="bg-red-500 border-0 hover:bg-red-700 btn btn-sm">
        Remove Service
    </button>
    @endif
</div>