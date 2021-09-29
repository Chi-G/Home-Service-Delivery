<?php

namespace App\Http\Livewire\Admin;

use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditServiceCategoryComponent extends Component
{
    use WithFileUploads;

    public $category_id;
    public $name;
    public $image;
    public $slug;
    public $newimage;

    public function mount($category_id)
    {
        $scategory = ServiceCategory::find($category_id);
        $this->category_id = $scategory->id;
        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
        $this->image = $scategory->image;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required', 
            'slug' => 'required'  
        ]);

        if ($this->newimage)
        {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:png,jpeg,jpg'
            ]);
        }
    }
    
    public function updateServiceCategory()
    {
        $this->validate( [
            'name' => 'required', 
            'slug' => 'required'            
        ]);

        if ($this->newimage)
        {
            $this->validate([
                'newimage' => 'required|mimes:png,jpeg,jpg'
            ]);
        }
        $scategory = ServiceCategory::find($this->category_id);
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;
        if($this->newimage)
        {
            $imageName = Carbon::now()->timestamp. '.' . $this->newimage->extension();
            $this->newimage->storeAs('categories', $imageName);
            $scategory->image = $imageName;            
        }
            $scategory->save();
            session()->flash('message', 'Category has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-service-category-component')->layout('layouts.base');
    }
}
