<?php

namespace App\Http\Livewire\Modals;

use App\Models\Project;
use App\Models\StatusBadge;
use LivewireUI\Modal\ModalComponent;

class ProjectStatusUpdateModal extends ModalComponent
{
    public $statuses;
    public $project;

    public function mount(Project $project)
    {
        $this->statuses = StatusBadge::pluck('name', 'name');
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.modals.project-status-update-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
