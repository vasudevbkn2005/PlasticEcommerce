<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-extrabold mb-8 text-center text-indigo-700 tracking-wide">User Detail</h1>

    <div class="overflow-x-auto shadow-lg rounded-lg bg-white border border-gray-200 mb-10">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Mobile</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Address</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($users as $user)
                    <tr
                        class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }} hover:bg-indigo-50 transition duration-200">
                        <td class="px-4 py-3">{{ $user->id }}</td>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->mobile }}</td>
                        <td class="px-4 py-3">{{ $user->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
