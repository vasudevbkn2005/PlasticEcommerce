<div class="p-10 bg-white rounded-lg shadow-md">
    <button wire:click="create" type="button"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
        + Create
    </button>

    <div class="overflow-x-auto mt-4" x-data="{ imageModal: false, modalImage: '' }">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">Edit</th>
                    <th class="border px-4 py-2">Delete</th>
                </tr>
            </thead>
            <tbody>
                @php $index = 1; @endphp
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border px-4 py-2">{{ $index++ }}</td>
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2">
                            @if ($category->cimage)
                                <img 
                                    src="{{ asset('storage/' . $category->cimage) }}" 
                                    @click="imageModal = true; modalImage = '{{ asset('storage/' . $category->cimage) }}'" 
                                    class="h-20 w-20 object-cover rounded border hover:opacity-80 cursor-pointer">
                            @else
                                <span class="text-gray-500 italic">N/A</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="edit({{ $category->id }})"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow">
                                Edit
                            </button>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="delete({{ $category->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Image Modal Viewer -->
        <div 
            x-show="imageModal" 
            x-transition.opacity 
            x-cloak 
            @keydown.escape.window="imageModal = false"
            class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
        >
            <div 
                class="bg-white rounded-lg shadow-lg p-4 max-w-lg w-full relative" 
                @click.away="imageModal = false"
            >
                <button 
                    @click="imageModal = false" 
                    class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl font-bold"
                >
                    &times;
                </button>
                <img :src="modalImage" class="max-w-[500px] max-h-[500px] w-auto h-auto rounded shadow">
            </div>
        </div>

        <!-- Create/Edit Modal -->
        @if ($showModal)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-40">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                    <h2 class="text-xl mb-4">{{ $category_id ? 'Edit Category' : 'Create New Category' }}</h2>
                    <form wire:submit.prevent="store">
                        <input type="text" wire:model="name" placeholder="Category name" class="border p-2 mb-4 w-full" required>
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                        @if ($existingImage)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Existing Image:</label>
                                <img src="{{ asset('storage/' . $existingImage) }}" class="h-32 w-32 rounded object-cover border shadow cursor-pointer" 
                                     @click="imageModal = true; modalImage = '{{ asset('storage/' . $existingImage) }}'">
                            </div>
                        @endif

                        <input type="file" wire:model="cimage" class="border p-2 mb-4 w-full" {{ $category_id ? '' : 'required' }}>
                        @error('cimage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                        <div class="flex justify-between items-center">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Save
                            </button>
                            <button type="button" wire:click="closeModal" class="text-red-500">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
