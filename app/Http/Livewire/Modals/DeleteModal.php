<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class DeleteModal extends ModalComponent
{
    public $item;

    public function mount($model, $record_id)
    {
        $this->item = $model::findOrFail($record_id);
    }

    public function deleteRecord()
    {
        $deleted = $this->item->delete();

        if ($deleted) {
            $this->emit('recordDeleted');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.modals.delete-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
