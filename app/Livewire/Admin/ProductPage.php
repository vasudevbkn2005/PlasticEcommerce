<?php

namespace App\Livewire\Admin;

use App\Models\Bulk;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductPage extends Component
{
    use WithFileUploads;

    public $products;
    public $allCategories;
    public $product_id;
    public $name, $category_ids = [], $description, $mimage, $oimages;
    public $priceInputs = [];
    public $showModal = false;
    public $bulk_order_quantity, $price;
    public $oldOimages = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'category_ids' => 'required|array|min:1',
        'category_ids.*' => 'exists:categories,id',
        'mimage' => 'required',
        'oimages.*' => 'nullable|image',
        'description' => 'nullable|string',
        'priceInputs.*.size' => 'required|string|max:50',
        'priceInputs.*.price' => 'required|numeric|min:0',
        'priceInputs.*.discount' => 'nullable|numeric|min:0|max:100',
        'bulk_order_quantity' => 'required',
        'price' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->allCategories = Category::all();
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.admin.product-page');
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

    public function removeOldOimage($index)
    {
        $image = $this->oldOimages[$index] ?? null;

        if ($image && isset($image['id'])) {
            if (Storage::disk('public')->exists($image['image_path'])) {
                Storage::disk('public')->delete($image['image_path']);
            }

            \App\Models\ProductImage::where('id', $image['id'])->delete();
        }

        unset($this->oldOimages[$index]);
        $this->oldOimages = array_values($this->oldOimages);
    }

    public function store()
    {
        $this->validate();

        $this->name = preg_replace_callback('/\b\w+\b/', function ($matches) {
            return ucfirst(strtolower($matches[0]));
        }, $this->name);

        if ($this->description) {
            $this->description = preg_replace_callback('/\b\w+\b/', function ($matches) {
                return ucfirst(strtoupper($matches[0]));
            }, $this->description);
        }

        if ($this->product_id) {
            $product = Product::findOrFail($this->product_id);

            // Update main image
            if (is_object($this->mimage)) {
                if ($product->mimage && Storage::disk('public')->exists($product->mimage)) {
                    Storage::disk('public')->delete($product->mimage);
                }
                $product->mimage = $this->mimage->store('products/main', 'public');
            }

            $product->name = $this->name;
            $product->description = $this->description;
            $product->save();

            $product->categories()->sync($this->category_ids);

            // Handle Other Images
            $product->otherImages()->delete();

            if (!empty($this->oimages)) {
                foreach ($this->oimages as $image) {
                    if (is_object($image)) {
                        $path = $image->store('products/others', 'public');
                        $product->otherImages()->create(['image_path' => $path]);
                    }
                }
            }

            // Handle Prices
            $product->prices()->delete();
            foreach ($this->priceInputs as $priceInput) {
                $final = $priceInput['price'] - ($priceInput['price'] * $priceInput['discount'] / 100);
                $product->prices()->create([
                    'size' => $priceInput['size'],
                    'price' => $priceInput['price'],
                    'discount' => $priceInput['discount'],
                    'final_price' => $final,
                ]);
            }

            // Handle Bulk Order
            if ($this->bulk_order_quantity && $this->price) {
                \App\Models\Bulk::updateOrCreate(
                    ['product_id' => $product->id],
                    [
                        'bulk_order_quantity' => $this->bulk_order_quantity,
                        'price' => $this->price,
                        'user_id' => Auth::id(),
                    ]
                );
            }

            session()->flash('message', 'Product updated successfully.');
        } else {
            // Create new product
            $mainImagePath = $this->mimage->store('products/main', 'public');

            $product = Product::create([
                'name' => $this->name,
                'mimage' => $mainImagePath,
                'description' => $this->description ?? null,
            ]);

            $product->categories()->attach($this->category_ids);

            // Add other images (limit to 2)
            if ($this->oimages) {
                foreach ($this->oimages as $image) {
                    if ($product->otherImages()->count() >= 2) break;
                    $imagePath = $image->store('products/others', 'public');
                    $product->otherImages()->create(['image_path' => $imagePath]);
                }
            }

            // Add prices
            foreach ($this->priceInputs as $priceInput) {
                $final = $priceInput['price'] - ($priceInput['price'] * $priceInput['discount'] / 100);
                $product->prices()->create([
                    'size' => $priceInput['size'],
                    'price' => $priceInput['price'],
                    'discount' => $priceInput['discount'],
                    'final_price' => $final,
                ]);
            }

            // Handle Bulk Order for new product
            if ($this->bulk_order_quantity && $this->price) {
                \App\Models\Bulk::create([
                    'product_id' => $product->id,
                    'bulk_order_quantity' => $this->bulk_order_quantity,
                    'price' => $this->price,
                    'user_id' => Auth::id(),
                ]);
            }

            session()->flash('message', 'Product created successfully.');
        }

        $this->resetForm();
        $this->showModal = false;
        $this->products = Product::all();
    }

    public function edit($id)
    {
        $product = Product::with('prices', 'otherImages', 'bulk')->find($id); // include 'bulk' if defined

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->category_ids = $product->categories->pluck('id')->toArray();
        $this->description = $product->description;
        $this->mimage = $product->mimage;

        $this->oldOimages = $product->otherImages->map(function ($img) {
            return [
                'id' => $img->id,
                'image_path' => $img->image_path
            ];
        })->toArray();

        $this->oimages = [];

        $this->priceInputs = $product->prices->map(function ($price) {
            return [
                'size' => $price->size,
                'price' => $price->price,
                'discount' => $price->discount,
                'final_price' => $price->final_price,
            ];
        })->toArray();

        // ✅ Load bulk data
        $bulk = Bulk::where('product_id', $product->id)->first();

        if ($bulk) {
            $this->bulk_order_quantity = $bulk->bulk_order_quantity;
            $this->price = $bulk->price;
        } else {
            $this->bulk_order_quantity = null;
            $this->price = null;
        }

        $this->showModal = true;
    }
    public function delete($id)
    {
        $product = Product::with(['otherImages'])->find($id);

        if ($product) {
            // Delete main image
            if ($product->mimage && Storage::disk('public')->exists($product->mimage)) {
                Storage::disk('public')->delete($product->mimage);
            }

            // Delete other images
            foreach ($product->otherImages as $otherImage) {
                if ($otherImage->image_path && Storage::disk('public')->exists($otherImage->image_path)) {
                    Storage::disk('public')->delete($otherImage->image_path);
                }
                $otherImage->delete();
            }

            // Delete prices
            $product->prices()->delete();

            // Delete product
            $product->delete();

            session()->flash('message', 'Product deleted successfully.');
        } else {
            session()->flash('message', 'Product not found.');
        }

        $this->products = Product::all();
    }

    public function addPriceRow()
    {
        $this->priceInputs[] = ['size' => '', 'price' => '', 'discount' => '', 'final_price' => ''];
    }

    public function removePriceRow($index)
    {
        unset($this->priceInputs[$index]);
        $this->priceInputs = array_values($this->priceInputs);
    }

    private function resetInputFields()
    {
        $this->product_id = null;
        $this->name = '';
        $this->category_ids = [];
        $this->description = '';
        $this->mimage = '';
        $this->oimages = [];
        $this->priceInputs = [];
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'category_ids',
            'mimage',
            'oimages',
            'priceInputs',
            'description',
        ]);

        $this->priceInputs = [['size' => '', 'price' => '', 'discount' => '']];
    }
}


// namespace App\Livewire\Admin;

// use Livewire\Component;
// use Livewire\WithFileUploads;
// use App\Models\Product;
// use App\Models\Category;
// use Illuminate\Support\Facades\Storage;

// class ProductPage extends Component
// {
//     use WithFileUploads;

//     public $products;
//     public $allCategories;
//     public $product_id;
//     public $name, $category_ids = [], $color, $description, $mimage, $oimages, $colorimage;
//     public $colorInputs = [];
//     public $priceInputs = [];
//     public $showModal = false;
//     public $oldOimages = [];


//     protected $rules = [
//         'name' => 'required|string|max:255',
//         'category_ids' => 'required|array|min:1',
//         'category_ids.*' => 'exists:categories,id',
//         'mimage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//         'oimages.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//         'colorInputs.*.color' => 'required|string',
//         'colorInputs.*.colorimage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//         'description' => 'nullable|string',
//         'priceInputs.*.size' => 'required|string',
//         'priceInputs.*.price' => 'required|numeric',
//         'priceInputs.*.discount' => 'nullable|numeric',
//     ];

//     public function mount()
//     {
//         $this->allCategories = Category::all();
//         $this->products = Product::all();
//     }

//     public function render()
//     {
//         return view('livewire.admin.product-page');
//     }

//     public function create()
//     {
//         $this->resetInputFields();
//         $this->showModal = true;
//     }

//     public function closeModal()
//     {
//         $this->resetInputFields();
//         $this->showModal = false;
//     }

//     public function removeOldOimage($index)
//     {
//         $image = $this->oldOimages[$index] ?? null;

//         if ($image && isset($image['id'])) {
//             // Delete image file from storage
//             if (Storage::disk('public')->exists($image['image_path'])) {
//                 Storage::disk('public')->delete($image['image_path']);
//             }

//             // Delete record from database
//             \App\Models\ProductImage::where('id', $image['id'])->delete();
//         }

//         // Remove from the Livewire array
//         unset($this->oldOimages[$index]);
//         $this->oldOimages = array_values($this->oldOimages);
//     }
//     public function store()
//     {
//         $this->validate([
//             'name' => 'required|string|max:255',
//             'category_ids' => 'required|array|min:1',
//             'category_ids.*' => 'exists:categories,id',
//             'mimage' => $this->product_id ? 'nullable' : 'required|image',
//             'oimages.*' => 'nullable|image',
//             'colorInputs.*.color' => 'nullable|string|max:100',
//             'colorInputs.*.colorimage' => 'nullable', // This will allow both existing and new uploads
//             'priceInputs.*.size' => 'required|string|max:50',
//             'priceInputs.*.price' => 'required|numeric|min:0',
//             'priceInputs.*.discount' => 'nullable|numeric|min:0|max:100',
//         ]);

//         // Custom validation for new color image uploads
//         foreach ($this->colorInputs as $index => $colorInput) {
//             // Check if colorimage is a file (new upload)
//             if (isset($colorInput['colorimage']) && is_object($colorInput['colorimage'])) {
//                 // Re-validate as an image (only when it's a new upload)
//                 $this->validate([
//                     "colorInputs.{$index}.colorimage" => 'image|nullable',
//                 ]);
//             }
//         }

//         // Formatting name and description
//         $this->name = ucfirst(strtolower($this->name));
//         $this->color = ucfirst(strtolower($this->color));
//         if ($this->description) {
//             $this->description = ucfirst(strtolower($this->description));
//         }

//         if ($this->product_id) {
//             // Update the product
//             $product = Product::findOrFail($this->product_id);

//             // Update main image
//             if (is_object($this->mimage)) {
//                 if ($product->mimage && Storage::disk('public')->exists($product->mimage)) {
//                     Storage::disk('public')->delete($product->mimage);
//                 }
//                 $product->mimage = $this->mimage->store('products/main', 'public');
//             }

//             $product->name = $this->name;
//             $product->description = $this->description;
//             $product->save();

//             // Sync categories
//             $product->categories()->sync($this->category_ids);

//             // --- Handle Other Images ---
//             $product->otherImages()->delete(); // Delete the old other images

//             // Re-add remaining old images
//             if (!empty($this->oldOimages)) {
//                 foreach ($this->oldOimages as $oldImage) {
//                     // Ensure that if the image file exists in public storage, it gets deleted
//                     if (Storage::disk('public')->exists($oldImage['image_path'])) {
//                         Storage::disk('public')->delete($oldImage['image_path']);
//                     }
//                     $product->otherImages()->create(['image_path' => $oldImage['image_path']]); // Keep old images
//                 }
//             }

//             // Add new uploaded images (limit to 2 images)
//             if (!empty($this->oimages)) {
//                 foreach ($this->oimages as $image) {
//                     if ($product->otherImages()->count() >= 2) break; // Limit to 2 images
//                     if (is_object($image)) {
//                         // Store the new image in public storage
//                         $path = $image->store('products/others', 'public');
//                         $product->otherImages()->create(['image_path' => $path]);
//                     }
//                 }
//             }

//             // --- Handle Colors ---
//             $product->colors()->delete(); // Delete existing colors

//             foreach ($this->colorInputs as $colorInput) {
//                 $color = ucfirst(strtolower($colorInput['color'] ?? ''));
//                 $colorImagePath = $colorInput['colorimage']; // Can be a file object or path

//                 // If new image is uploaded
//                 if (is_object($colorInput['colorimage'])) {
//                     // Delete the old image if available
//                     if (!empty($colorInput['old_path']) && Storage::disk('public')->exists($colorInput['old_path'])) {
//                         Storage::disk('public')->delete($colorInput['old_path']);
//                     }

//                     // Store the new image
//                     $colorImagePath = $colorInput['colorimage']->store('products/colors', 'public');
//                 }

//                 $product->colors()->create([
//                     'color' => $color,
//                     'colorimage' => $colorImagePath,
//                 ]);
//             }

//             // --- Handle Prices ---
//             $product->prices()->delete(); // Delete old prices
//             foreach ($this->priceInputs as $priceInput) {
//                 $price = $priceInput['price'];
//                 $discount = $priceInput['discount'] ?? 0;
//                 $final = $price - ($price * $discount / 100);
//                 $product->prices()->create([
//                     'size' => $priceInput['size'],
//                     'price' => $price,
//                     'discount' => $discount,
//                     'final_price' => $final,
//                 ]);
//             }

//             session()->flash('message', 'Product updated successfully.');
//         } else {
//             // Create new product
//             $mainImagePath = $this->mimage->store('products/main', 'public');

//             $product = Product::create([
//                 'name' => $this->name,
//                 'mimage' => $mainImagePath,
//                 'description' => $this->description ?? null,
//             ]);

//             $product->categories()->attach($this->category_ids);

//             // Add other images (limit to 2)
//             if ($this->oimages) {
//                 foreach ($this->oimages as $image) {
//                     if ($product->otherImages()->count() >= 2) break;
//                     $imagePath = $image->store('products/others', 'public');
//                     $product->otherImages()->create(['image_path' => $imagePath]);
//                 }
//             }

//             // Add colors
//             foreach ($this->colorInputs as $colorInput) {
//                 $colorImagePath = $colorInput['colorimage']->store('products/colors', 'public');
//                 $product->colors()->create([
//                     'color' => $colorInput['color'],
//                     'colorimage' => $colorImagePath,
//                 ]);
//             }

//             // Add prices
//             foreach ($this->priceInputs as $priceInput) {
//                 $price = $priceInput['price'];
//                 $discount = $priceInput['discount'] ?? 0;
//                 $final = $price - ($price * $discount / 100);
//                 $product->prices()->create([
//                     'size' => $priceInput['size'],
//                     'price' => $price,
//                     'discount' => $discount,
//                     'final_price' => $final,
//                 ]);
//             }

//             session()->flash('message', 'Product created successfully.');
//         }

//         $this->resetForm();
//         $this->showModal = false;
//         $this->products = Product::all();
//     }

//     public function edit($id)
//     {
//         $product = Product::with('prices', 'otherImages', 'colors')->find($id);

//         $this->product_id = $product->id;
//         $this->name = $product->name;
//         $this->category_ids = $product->categories->pluck('id')->toArray();
//         $this->color = $product->color;
//         $this->description = $product->description;
//         $this->mimage = $product->mimage;

//         // Load existing other images
//         $this->oldOimages = $product->otherImages->map(function ($img) {
//             return [
//                 'id' => $img->id,
//                 'image_path' => $img->image_path
//             ];
//         })->toArray();

//         // Clear oimages for new uploads
//         $this->oimages = [];

//         // Load existing colors (keep path and use it unless user uploads a new file)
//         $this->colorInputs = $product->colors->map(function ($color) {
//             return [
//                 'color' => $color->color,
//                 'colorimage' => $color->colorimage, // Will be used in Livewire file input or as preview
//                 'old_path' => $color->colorimage,   // Used to delete the old image if replaced
//             ];
//         })->toArray();

//         // Load price inputs
//         $this->priceInputs = $product->prices->map(function ($price) {
//             return [
//                 'size' => $price->size,
//                 'price' => $price->price,
//                 'discount' => $price->discount,
//                 'final_price' => $price->final_price,
//             ];
//         })->toArray();

//         $this->showModal = true;
//     }

    




//     // public function store()
//     // {
//     //     $this->validate([
//     //         'name' => 'required|string|max:255',
//     //         'category_ids' => 'required|array|min:1',
//     //         'category_ids.*' => 'exists:categories,id',
//     //         'mimage' => $this->product_id ? 'nullable' : 'required|image',
//     //         'oimages.*' => 'nullable|image',
//     //         'colorInputs.*.color' => 'nullable|string|max:100',
//     //         'colorInputs.*.colorimage' => 'nullable|image',
//     //         'priceInputs.*.size' => 'required|string|max:50',
//     //         'priceInputs.*.price' => 'required|numeric|min:0',
//     //         'priceInputs.*.discount' => 'nullable|numeric|min:0|max:100',
//     //     ]);
//     //     $this->name = ucfirst(strtolower($this->name));
//     //     $this->color = ucfirst(strtolower($this->color));
//     //     if ($this->description) {
//     //         $this->description = ucfirst(strtolower($this->description));  // Use ucfirst() for first letter capitalization
//     //     }


//     //     if ($this->product_id) {
//     //         // Update
//     //         $product = Product::findOrFail($this->product_id);

//     //         // If a new main image was uploaded
//     //         if (is_object($this->mimage)) {
//     //             if ($product->mimage && Storage::disk('public')->exists($product->mimage)) {
//     //                 Storage::disk('public')->delete($product->mimage);
//     //             }
//     //             $product->mimage = $this->mimage->store('products/main', 'public');
//     //         }

//     //         $product->name = $this->name;
//     //         $product->description = $this->description;
//     //         $product->save();

//     //         // Sync categories
//     //         $product->categories()->sync($this->category_ids);

//     //         // Delete old otherImages and recreate
//     //         $product->otherImages()->delete();
//     //         if ($this->oimages) {
//     //             foreach ($this->oimages as $image) {
//     //                 $path = is_object($image) ? $image->store('products/others', 'public') : $image;
//     //                 $product->otherImages()->create(['image_path' => $path]);
//     //             }
//     //         }

//     //         // Delete old colors and recreate
//     //         $product->colors()->delete();
//     //         foreach ($this->colorInputs as $colorInput) {
//     //             $colorInput['color'] = ucfirst(strtolower($colorInput['color']));
//     //             $colorImagePath = is_object($colorInput['colorimage'])
//     //                 ? $colorInput['colorimage']->store('products/colors', 'public')
//     //                 : $colorInput['colorimage'];
//     //             $product->colors()->create([
//     //                 'color' => $colorInput['color'],
//     //                 'colorimage' => $colorImagePath,
//     //             ]);
//     //         }

//     //         // Delete old prices and recreate
//     //         $product->prices()->delete();
//     //         foreach ($this->priceInputs as $priceInput) {
//     //             $price = $priceInput['price'];
//     //             $discount = $priceInput['discount'] ?? 0;
//     //             $final = $price - ($price * $discount / 100);
//     //             $product->prices()->create([
//     //                 'size' => $priceInput['size'],
//     //                 'price' => $price,
//     //                 'discount' => $discount,
//     //                 'final_price' => $final,
//     //             ]);
//     //         }

//     //         session()->flash('message', 'Product updated successfully.');
//     //     } else {
//     //         // Create new product
//     //         $mainImagePath = $this->mimage->store('products/main', 'public');

//     //         $product = Product::create([
//     //             'name' => $this->name,
//     //             'mimage' => $mainImagePath,
//     //             'description' => $this->description ?? null,
//     //         ]);

//     //         $product->categories()->attach($this->category_ids);

//     //         if ($this->oimages) {
//     //             foreach ($this->oimages as $image) {
//     //                 $imagePath = $image->store('products/others', 'public');
//     //                 $product->otherImages()->create(['image_path' => $imagePath]);
//     //             }
//     //         }

//     //         foreach ($this->colorInputs as $colorInput) {
//     //             $colorImagePath = $colorInput['colorimage']->store('products/colors', 'public');
//     //             $product->colors()->create([
//     //                 'color' => $colorInput['color'],
//     //                 'colorimage' => $colorImagePath,
//     //             ]);
//     //         }

//     //         foreach ($this->priceInputs as $priceInput) {
//     //             $price = $priceInput['price'];
//     //             $discount = $priceInput['discount'] ?? 0;
//     //             $final = $price - ($price * $discount / 100);
//     //             $product->prices()->create([
//     //                 'size' => $priceInput['size'],
//     //                 'price' => $price,
//     //                 'discount' => $discount,
//     //                 'final_price' => $final,
//     //             ]);
//     //         }

//     //         session()->flash('message', 'Product created successfully.');
//     //     }

//     //     $this->resetForm();
//     //     $this->showModal = false;
//     //     $this->products = Product::all();
//     // }


//     // public function edit($id)
//     // {
//     //     $product = Product::with('prices', 'otherImages', 'colors')->find($id);
//     //     $this->product_id = $product->id;
//     //     $this->name = $product->name;
//     //     $this->category_ids = $product->categories->pluck('id')->toArray();
//     //     $this->color = $product->color;
//     //     $this->description = $product->description;

//     //     // Set existing image paths separately
//     //     $this->mimage = $product->mimage;
//     //     $this->oldOimages = $product->otherImages->map(function ($img) {
//     //         return [
//     //             'id' => $img->id,
//     //             'image_path' => $img->image_path
//     //         ];
//     //     })->toArray();

//     //     $this->oimages = []; // for new uploads only

//     //     $this->colorInputs = json_decode($product->colorimages, true) ?? [];
//     //     $this->priceInputs = $product->prices->map(function ($price) {
//     //         return [
//     //             'size' => $price->size,
//     //             'price' => $price->price,
//     //             'discount' => $price->discount,
//     //             'final_price' => $price->final_price,
//     //         ];
//     //     })->toArray();

//     //     $this->showModal = true;
//     // }




//     public function delete($id)
//     {
//         $product = Product::with(['otherImages', 'colors'])->find($id);

//         if ($product) {
//             // Delete main image
//             if ($product->mimage && Storage::disk('public')->exists($product->mimage)) {
//                 Storage::disk('public')->delete($product->mimage);
//             }

//             // Delete other images
//             foreach ($product->otherImages as $otherImage) {
//                 if ($otherImage->image_path && Storage::disk('public')->exists($otherImage->image_path)) {
//                     Storage::disk('public')->delete($otherImage->image_path);
//                 }
//                 $otherImage->delete();
//             }

//             // Delete color images
//             foreach ($product->colors as $color) {
//                 if ($color->colorimage && Storage::disk('public')->exists($color->colorimage)) {
//                     Storage::disk('public')->delete($color->colorimage);
//                 }
//                 $color->delete();
//             }

//             // Delete prices
//             $product->prices()->delete();

//             // Delete product
//             $product->delete();

//             session()->flash('message', 'Product deleted successfully.');
//         } else {
//             session()->flash('message', 'Product not found.');
//         }

//         $this->products = Product::all();
//     }


//     // public function delete($id)
//     // {
//     //     // Find the product by ID
//     //     $product = Product::find($id);

//     //     if ($product) {
//     //         // Delete the main image
//     //         Storage::disk('public')->delete($product->mimage);

//     //         // Check if there are other images and delete them
//     //         if ($product->oimages) {
//     //             foreach (json_decode($product->oimages) as $oimage) {
//     //                 Storage::disk('public')->delete($oimage);
//     //             }
//     //         }

//     //         // Check if there are color images and delete them
//     //         if ($product->colorimages) {
//     //             foreach (json_decode($product->colorimages) as $colorimage) {
//     //                 Storage::disk('public')->delete($colorimage);
//     //             }
//     //         }

//     //         // Delete associated prices
//     //         $product->prices()->delete();

//     //         // Delete the product
//     //         $product->delete();

//     //         // Flash success message
//     //         session()->flash('message', 'Product deleted successfully.');
//     //     } else {
//     //         // Handle the case where the product doesn't exist
//     //         session()->flash('message', 'Product not found.');
//     //     }

//     //     // Reload products to reflect changes
//     //     $this->products = Product::all();
//     // }

//     public function addPriceRow()
//     {
//         $this->priceInputs[] = ['size' => '', 'price' => '', 'discount' => '', 'final_price' => ''];
//     }

//     public function removePriceRow($index)
//     {
//         unset($this->priceInputs[$index]);
//         $this->priceInputs = array_values($this->priceInputs);
//     }

//     public function addColorRow()
//     {
//         $this->colorInputs[] = ['color' => '', 'colorimage' => ''];
//     }

//     public function removeColorRow($index)
//     {
//         unset($this->colorInputs[$index]);
//         $this->colorInputs = array_values($this->colorInputs);
//     }

//     private function resetInputFields()
//     {
//         $this->product_id = null;
//         $this->name = '';
//         $this->category_ids = [];
//         $this->color = '';
//         $this->description = '';
//         $this->mimage = '';
//         $this->oimages = [];
//         $this->colorInputs = [];
//         $this->priceInputs = [];
//     }

//     public function resetForm()
//     {
//         $this->reset([
//             'name',
//             'category_ids',
//             'mimage',
//             'oimages',
//             'colorInputs',
//             'priceInputs',
//             'description',
//         ]);

//         $this->priceInputs = [['size' => '', 'price' => '', 'discount' => '']];
//         $this->colorInputs = [];
//     }
// }
