<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Vendor;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class FilamentCreate extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $vendor_id = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('vendorId')
                ->label('Customer')
                ->options(Vendor::all()->pluck('name', 'id'))
                ->searchable()
        ];
    }

    public function render()
    {
        return view('livewire.forms.invoice.filament-create');
    }
}
