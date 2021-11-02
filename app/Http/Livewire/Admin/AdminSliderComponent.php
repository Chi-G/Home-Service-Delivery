<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Slider;

class AdminSliderComponent extends Component
{
    use WithPagination;

    public function deleteSlide($slide_id)
    {
        $slide = Slider::find($slide_id);
        if($slide->image)        
        {
            unlink('images/slider/' .$slide->image);
        }
        $slide->delete();
        session()->flash('message', 'Slide has been deleted successfully!');
    }

    public function render()
    {
        $slides = Slider::Paginate('10');
        return view('livewire.admin.admin-slider-component', ['slides' => $slides])->layout('layouts.base');
    }
}
