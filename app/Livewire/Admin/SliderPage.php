<?php

namespace App\Livewire\Admin;

use App\Models\Slide;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class SliderPage extends Component
{
    use WithFileUploads;

    public $image, $mobile_image, $slider_id;
    public $isOpen = false;
    public $showModal = false;
    public $existingImage, $existingMobileImage;

    public function resetInputFields()
    {
        $this->image = null;
        $this->mobile_image = null;
        $this->slider_id = '';
        $this->existingImage = null;
        $this->existingMobileImage = null;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate([
            'image' => $this->slider_id ? 'nullable|image' : 'required|image',
            'mobile_image' => 'nullable|image',
        ]);

        $slider = $this->slider_id ? Slide::find($this->slider_id) : null;

        $desktopFilename = $slider?->image;
        $mobileFilename = $slider?->mobile_image;

        // Handle desktop image
        if ($this->image) {
            if ($slider && $slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $desktopFilename = $this->image->store('sliders', 'public');
        }

        // Handle mobile image
        if ($this->mobile_image) {
            if ($slider && $slider->mobile_image && Storage::disk('public')->exists($slider->mobile_image)) {
                Storage::disk('public')->delete($slider->mobile_image);
            }
            $mobileFilename = $this->mobile_image->store('sliders', 'public');
        }

        $sliderData = [
            'image' => $desktopFilename,
            'mobile_image' => $mobileFilename,
        ];

        if ($this->slider_id) {
            Slide::updateOrCreate(['id' => $this->slider_id], $sliderData);
        } else {
            Slide::create($sliderData);
        }

        session()->flash('message', $this->slider_id ? 'Slider Updated Successfully.' : 'Slider Created Successfully.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $slider = Slide::findOrFail($id);
        $this->slider_id = $slider->id;
        $this->existingImage = $slider->image;
        $this->existingMobileImage = $slider->mobile_image;
        $this->showModal = true;
    }

    public function delete($id)
    {
        $slider = Slide::findOrFail($id);

        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        if ($slider->mobile_image && Storage::disk('public')->exists($slider->mobile_image)) {
            Storage::disk('public')->delete($slider->mobile_image);
        }

        $slider->delete();

        session()->flash('message', 'Slider Deleted Successfully.');
    }

    public function render()
    {
        $sliders = Slide::all();
        return view('livewire.admin.slider-page', compact('sliders'));
    }
}
