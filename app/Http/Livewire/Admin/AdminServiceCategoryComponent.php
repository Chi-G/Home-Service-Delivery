<?php

namespace App\Http\Livewire\Admin;

use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServiceCategoryComponent extends Component
{
    use WithPagination;

    public function deleteServiceCategory($id)
    {
        $scategories = ServiceCategory::find($id);
        if($scategories->image)
        {
            unlink('images/categories'.'/'.$scategories->image);
        }
        $scategories->delete();
        session()->flash('message', 'Service Category has been deleted successfully!');
    }

    public function render()
    {
        $scategories = ServiceCategory::paginate(5);
        return view('livewire.admin.admin-service-category-component', ['scategories' => $scategories])->layout('layouts.base');
    }
}
