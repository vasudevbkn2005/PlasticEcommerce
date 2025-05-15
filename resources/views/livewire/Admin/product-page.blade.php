<div>
    <h1 class="text-2xl font-bold mb-4">Product Page</h1>

    <div class="p-10 bg-white rounded-lg shadow-md">
        <button wire:click="create" type="button"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
            + Create Product
        </button>


        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto mt-4" x-data="{ imageModal: false, modalImage: '' }">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Category</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Main Image</th>
                        <th class="border px-4 py-2">Other Image</th>
                        <th class="border px-4 py-2">Size</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Discount</th>
                        <th class="border px-4 py-2">Final Price</th>
                        <th class="border px-4 py-2">Bulk Quantity</th>
                        <th class="border px-4 py-2">Bulk Price</th>
                        <th class="border px-4 py-2">Edit</th>
                        <th class="border px-4 py-2">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @php
                            $pricesCount = is_iterable($product->prices) ? $product->prices->count() : 0;
                            $colorsCount = is_iterable($product->colors) ? $product->colors->count() : 0;
                            $rowCount = max($pricesCount, 1);
                        @endphp

                        @for ($i = 0; $i < $rowCount; $i++)
                            <tr class="hover:bg-gray-50 transition">

                                {{-- Index --}}
                                @if ($i === 0)
                                    <td class="border px-4 py-2" rowspan="{{ $rowCount }}">{{ $loop->iteration }}
                                    </td>

                                    {{-- Categories --}}
                                    <td class="border px-4 py-2" rowspan="{{ $rowCount }}">
                                        @if ($product->categories->isNotEmpty())
                                            @foreach ($product->categories as $category)
                                                {{ $category->name ?? 'N/A' }}{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    {{-- Name --}}
                                    <td class="border px-4 py-2" rowspan="{{ $rowCount }}">
                                        {{ $product->name ?? 'N/A' }}</td>

                                    {{-- Main Image --}}
                                    <td class="border px-4 py-2" rowspan="{{ $rowCount }}">
                                        @if ($product->mimage)
                                            <img src="{{ asset('storage/' . $product->mimage) }}"
                                                @click="imageModal = true; modalImage = '{{ asset('storage/' . $product->mimage) }}'"
                                                class="h-20 w-20 object-cover rounded cursor-pointer border hover:opacity-80"
                                                alt="Main Image">
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    {{-- Other Images --}}
                                    <td class="border px-4 py-2" rowspan="{{ $rowCount }}">
                                        @if ($product->otherImages->isNotEmpty())
                                            @foreach ($product->otherImages as $img)
                                                @if ($img->image_path)
                                                    <img src="{{ asset('storage/' . $img->image_path) }}"
                                                        @click="imageModal = true; modalImage = '{{ asset('storage/' . $img->image_path) }}'"
                                                        class="h-12 w-12 object-cover rounded cursor-pointer border hover:opacity-80 mb-1 inline-block"
                                                        alt="Other Image">
                                                @endif
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                @endif

                                {{-- Prices --}}
                                <td class="border px-4 py-2">
                                    {{ $product->prices[$i]->size ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">
                                    ₹{{ $product->prices[$i]->price ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ number_format($product->prices[$i]->discount, 0) }}%
                                </td>
                                <td class="border px-4 py-2">
                                    ₹{{ $product->prices[$i]->final_price ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{$product->bulk->bulk_order_quantity ?? 'N/A'}}
                                </td>
                                <td class="border px-4 py-2">
                                    ₹{{$product->bulk->price ?? 'N/A'}}
                                </td>

                                {{-- Colors --}}
                                {{-- <td class="border px-4 py-2">
                                    {{ $product->colors[$i]->color ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">
                                    @if (isset($product->colors[$i]->colorimage))
                                        <img src="{{ asset('storage/' . $product->colors[$i]->colorimage) }}"
                                            @click="imageModal = true; modalImage = '{{ asset('storage/' . $product->colors[$i]->colorimage) }}'"
                                            class="h-20 w-20 object-cover rounded cursor-pointer border hover:opacity-80"
                                            alt="Color Image">
                                    @else
                                        N/A
                                    @endif
                                </td> --}}

                                {{-- Edit/Delete --}}
                                @if ($i === 0)
                                    <td class="border px-4 py-2 text-center" rowspan="{{ $rowCount }}">
                                        <button wire:click="edit({{ $product->id }})"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow">
                                            Edit
                                        </button>
                                    </td>
                                    <td class="border px-4 py-2 text-center" rowspan="{{ $rowCount }}">
                                        <button wire:click="delete({{ $product->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">
                                            Delete
                                        </button>
                                    </td>
                                @endif

                            </tr>
                        @endfor
                    @endforeach
                </tbody>
            </table>

            <!-- Modal for Image Viewer -->
            <div x-show="imageModal" x-transition.opacity x-cloak @keydown.escape.window="imageModal = false"
                class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
                <div @click.away="imageModal = false"
                    class="bg-white p-4 rounded-lg shadow-lg relative max-w-lg w-full">
                    <button @click="imageModal = false"
                        class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl font-bold"
                        aria-label="Close Modal">&times;</button>
                    <img :src="modalImage" class="max-w-[500px] max-h-[500px] rounded shadow">
                </div>
            </div>

            <!-- Create/Edit Product Modal -->
            @if ($showModal)
                <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-40">
                    <div class="bg-white p-6 rounded shadow-lg w-full max-w-lg max-h-[80vh] overflow-y-auto">
                        <h2 class="text-xl font-semibold mb-4">
                            {{ $product_id ? 'Edit Product' : 'Create New Product' }}</h2>
                        <form wire:submit.prevent="store">

                            {{-- Category --}}
                            <div class="mb-4">
                                <label class="block mb-2 font-semibold">Select Categories:</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
                                    @foreach ($allCategories as $cat)
                                        <label class="inline-flex items-center space-x-2">
                                            <input type="checkbox" wire:model="category_ids"
                                                value="{{ $cat->id }}" class="form-checkbox">
                                            <span>{{ $cat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                @error('category_ids')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Name --}}
                            <input type="text" wire:model="name" placeholder="Product name"
                                class="border p-2 mb-4 w-full" style="text-transform: capitalize;"
                                aria-label="Product Name">
                            @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                            {{-- Main Image --}}
                            <label for="mimage" class="block">Main Image</label>
                            <input type="file" wire:model="mimage" id="mimage" class="border p-2 mb-4 w-full"
                                aria-label="Upload Main Image">
                            @error('mimage')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            @if ($mimage)
                                <div class="mt-2">
                                    <h4 class="text-sm">Preview:</h4>
                                    @if (is_object($mimage))
                                        <img src="{{ $mimage->temporaryUrl() }}"
                                            class="w-20 h-20 object-cover rounded">
                                    @else
                                        <img src="{{ asset('storage/' . $mimage) }}"
                                            class="w-20 h-20 object-cover rounded">
                                    @endif
                                </div>
                            @endif

                            {{-- Other Images --}}
                            <label for="oimage" class="block">Other Images</label>
                            <input type="file" id="oimage" wire:model="oimages" class="border p-2 mb-4 w-full"
                                multiple aria-label="Upload Other Images">
                            @error('oimages')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                            @if ($oldOimages || $oimages)
                                <div class="mt-2">
                                    <h4 class="text-sm">Preview:</h4>

                                    {{-- Preview Existing Images --}}
                                    @foreach ($oldOimages as $index => $img)
                                        <div class="inline-block relative mr-2">
                                            <img src="{{ asset('storage/' . $img['image_path']) }}"
                                                class="w-20 h-20 object-cover rounded">
                                            <button type="button" wire:click="removeOldOimage({{ $index }})"
                                                class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">x</button>
                                        </div>
                                    @endforeach

                                    {{-- Preview New Uploads --}}
                                    @foreach ($oimages as $image)
                                        @if (is_object($image))
                                            <img src="{{ $image->temporaryUrl() }}"
                                                class="w-20 h-20 object-cover rounded inline-block mr-2">
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            {{-- Colors --}}
                            {{-- <h3 class="text-sm font-semibold mb-1">Colors:</h3>
                            @foreach ($colorInputs as $i => $colorInput)
                                <div class="flex gap-2 mb-2" wire:key="color-{{ $i }}">
                                    <input type="text" style="text-transform: capitalize;"
                                        wire:model="colorInputs.{{ $i }}.color" placeholder="Color"
                                        class="border p-1 w-1/3" aria-label="Color">
                                    <input type="file" wire:model="colorInputs.{{ $i }}.colorimage"
                                        class="border p-1 w-1/3" aria-label="Color Image">
                                    <button type="button" wire:click="removeColorRow({{ $i }})"
                                        class="text-red-500 text-sm" aria-label="Remove Color Row">
                                        Remove
                                    </button>
                                </div>
                            @endforeach
                            <button type="button" wire:click="addColorRow" class="text-blue-600 text-sm mt-2">+ Add
                                More Colors</button>
                            @error('colorInputs.*.color')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            @error('colorInputs.*.colorimage')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror --}}

                            {{-- Description --}}
                            <textarea wire:model="description" placeholder="Description" class="border p-2 mb-4 w-full" rows="3"
                                aria-label="Product Description" style="text-transform: capitalize;"></textarea>
                            @error('description')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                            <div class="mt-4">
                                <h3 class="text-sm font-semibold mb-1">Prices:</h3>
                                @foreach ($priceInputs as $i => $price)
                                    <div class="flex gap-2 mb-2 items-center" wire:key="price-{{ $i }}">
                                        <input type="text" wire:model="priceInputs.{{ $i }}.size"
                                            placeholder="Size" class="border p-1 w-1/4" aria-label="Price Size">
                                        <input type="number" step="0.01"
                                            wire:model="priceInputs.{{ $i }}.price" placeholder="Price"
                                            class="border p-1 w-1/4" aria-label="Price Amount">
                                        <input type="number" step="0.01"
                                            wire:model="priceInputs.{{ $i }}.discount"
                                            placeholder="Discount" class="border p-1 w-1/4"
                                            aria-label="Price Discount">
                                        <button type="button" wire:click="removePriceRow({{ $i }})"
                                            class="text-red-500 text-xs">Remove</button>
                                    </div>
                                @endforeach
                                <button type="button" wire:click="addPriceRow" class="text-blue-600 text-sm mt-2">
                                    + Add More Sizes
                                </button>
                            </div>
                            <div class="mb-4">
                                <!-- Bulk Order Quantity -->
                                <label for="bulkOrder" class="block font-semibold mb-2">Bulk Order Quantity:</label>
                                <input type="text" id="bulkOrder" wire:model="bulk_order_quantity"
                                    placeholder="Enter quantity" min="1"
                                    class="border p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    aria-label="Bulk Order Quantity">
                                @error('bulk_order_quantity')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                <small class="text-gray-500 text-xs">Enter the quantity for bulk orders (must be a
                                    positive integer).</small>

                                <!-- Price Input -->
                                <label for="price" class="block font-semibold mt-4 mb-2">Bulk Price:</label>
                                <input type="number" id="price" wire:model="price"
                                    placeholder="Enter Bulk Price" step="0.01"
                                    class="border p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    aria-label="Price">
                                @error('price')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex justify-between mt-6">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                                <button type="button" wire:click="closeModal" class="text-red-500 font-semibold"
                                    aria-label="Cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
