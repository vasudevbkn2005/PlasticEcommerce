<div class="container mt-5">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Title -->
    <h2 class="text-2xl font-bold mb-4">Manage Slides</h2>

    <!-- Create Slide Button -->
    <button wire:click="create" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow mb-4">
        + Create New Slide
    </button>

    <!-- Existing Slides -->
    <div class="overflow-x-auto mt-4">
        <table class="w-full table-auto border-collapse bg-white shadow-md rounded-lg">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">Mobile Image</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliders as $slide)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">
                            <img src="{{ Storage::url($slide->image) }}" alt="Slide Image"
                                class="h-20 w-20 object-cover rounded">
                        </td>
                        <td class="border px-4 py-2">
                            <img src="{{ Storage::url($slide->mobile_image) }}" alt="Slide Image"
                                class="h-20 w-20 object-cover rounded">
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="edit({{ $slide->id }})"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded shadow">
                                Edit
                            </button>
                            <button wire:click="delete({{ $slide->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Create/Edit Slide -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-transition.opacity x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-40">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl mb-4">{{ $slider_id ? 'Edit Slide' : 'Create New Slide' }}</h2>
            <form wire:submit.prevent="store">
                <div class="form-group mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Slide Image</label>
                    <!-- Use key to reset input field between create and edit -->
                    <input type="file" wire:model="image" id="image" key="{{ $slider_id }}"
                        class="border p-2 w-full rounded" accept="image/*">
                    @error('image')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>


                @if ($existingImage)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Existing Image:</label>
                        <img src="{{ Storage::url($existingImage) }}"
                            class="h-32 w-32 rounded object-cover shadow cursor-pointer"
                            @click="openImageModal = true; modalImage = '{{ Storage::url($existingImage) }}'">
                    </div>
                @endif

                <div class="form-group mb-4">
                    <label for="mobile_image" class="block text-sm font-medium text-gray-700">Mobile Slide Image</label>
                    <input type="file" wire:model="mobile_image" id="mobile_image" key="mobile_{{ $slider_id }}"
                        class="border p-2 w-full rounded" accept="image/*">
                    @error('mobile_image')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                @if ($existingMobileImage)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Existing Mobile Image:</label>
                        <img src="{{ Storage::url($existingMobileImage) }}"
                            class="h-32 w-32 rounded object-cover shadow cursor-pointer">
                    </div>
                @endif


                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Slide</button>
                    <button type="button" wire:click="closeModal" class="text-red-500">Cancel</button>
                </div>
            </form>
        </div>

        {{-- <!-- Image Modal Viewer -->
        <div x-show="imageModal" x-transition.opacity x-cloak @keydown.escape.window="imageModal = false"
            class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-4 max-w-lg w-full relative" @click.away="imageModal = false">
                <button @click="imageModal = false"
                    class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl font-bold">
                    &times;
                </button>
                <img :src="modalImage" class="max-w-[500px] max-h-[500px] w-auto h-auto rounded shadow">
            </div>
        </div>
    </div> --}}

        <!-- Add some custom styles -->
        <style>
            .card-img-top {
                object-fit: cover;
                height: 200px;
            }

            .table-auto th,
            .table-auto td {
                padding: 1rem;
                text-align: left;
            }
        </style>
    </div>
