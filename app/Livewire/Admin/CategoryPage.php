<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class CategoryPage extends Component
{
    use WithFileUploads;
    public $categories, $name, $cimage, $category_id;
    public $isOpen = false;
    public $showModal = false; // Ensure this is here
    public $existingImage;

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.admin.category-page');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->cimage = null;
        $this->category_id = '';
        $this->existingImage = null;
    }

    // Create function to show the modal
    public function create()
    {
        $this->showModal = true; // Show the modal when create is triggered
    }

    // Close the modal
    public function closeModal()
    {
        $this->showModal = false; // Hide the modal
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'cimage' => $this->category_id ? 'nullable|image' : 'required|image',
        ]);

        $category = $this->category_id ? Category::find($this->category_id) : null;
        $filename = $category?->cimage;

        if ($this->cimage) {
            // Delete the old image if exists
            if ($category && $category->cimage && Storage::disk('public')->exists($category->cimage)) {
                Storage::disk('public')->delete($category->cimage);
            }

            // Store the new image
            $filename = $this->cimage->storeAs('categories', $this->cimage->getClientOriginalName(), 'public');
        }

        $categoryData = [
            'name' => $this->name,
            'cimage' => $filename,
        ];

        if ($this->category_id) {
            Category::updateOrCreate(['id' => $this->category_id], $categoryData);
        } else {
            Category::create($categoryData);
        }

        session()->flash('message', $this->category_id ? 'Category Updated Successfully.' : 'Category Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->existingImage = $category->cimage; // Set the image for preview
        $this->showModal = true;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        // Delete image from storage if exists
        if ($category->cimage && Storage::disk('public')->exists($category->cimage)) {
            Storage::disk('public')->delete($category->cimage);
        }

        $category->delete();

        session()->flash('message', 'Category Deleted Successfully.');
    }
}
