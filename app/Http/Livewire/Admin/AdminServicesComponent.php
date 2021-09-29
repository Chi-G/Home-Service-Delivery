<?php

namespace App\Http\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServicesComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $service = Service::paginate(5);
        return view('livewire.admin.admin.services.component')->layout('layouts.base');
    }
}