<?php

namespace App\Http\Livewire\Modals;

use App\Traits\FlashMessages;
use LivewireUI\Modal\ModalComponent;

class RedirectAfterDeleteModal extends ModalComponent
{
    use FlashMessages;

    public $item, $route;

    public function mount($model, $record_id, $route)
    {
        $this->item = $model::findOrFail($record_id);
        $this->route = $route;
    }

    public function deleteRecord()
    {
        $deleted = $this->item->delete();

        if ($deleted) {
            $this->setFlashMessage('Record Deleted', 'success');
            $this->showFlashMessages();

            return redirect()->route($this->route);
        }
    }

    public function render()
    {
        return view('livewire.modals.redirect-after-delete-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
