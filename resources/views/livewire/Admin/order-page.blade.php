<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-extrabold mb-8 text-center text-indigo-700 tracking-wide">Order History</h1>

    <div class="overflow-x-auto shadow-lg rounded-lg bg-white border border-gray-200 mb-10">
        <table class="min-w-full border-collapse">
            <thead class="bg-indigo-200 text-indigo-900 uppercase text-sm font-semibold tracking-wide">
                <tr>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Order ID</th>
                    <th class="py-3 px-6 text-left">Customer</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Mobile</th>
                    <th class="py-3 px-6 text-left">Address</th>
                    <th class="py-3 px-6 text-left">City</th>
                    <th class="py-3 px-6 text-left">Pin Code</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @foreach ($orders as $order)
                    <tr
                        class="border-b border-gray-200 hover:bg-indigo-200 transition-colors duration-200 cursor-pointer">
                        <td class="py-3 px-6 font-medium text-indigo-600">
                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)"
                                class="border border-gray-300 rounded px-2 py-1 text-sm text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </td>
                        <td class="py-3 px-6 text-indigo-700 font-semibold">{{ $order->id }}</td>
                        <td class="py-3 px-6">{{ $order->fullName }}</td>
                        <td class="py-3 px-6 break-all">{{ $order->email }}</td>
                        <td class="py-3 px-6">{{ $order->mobile }}</td>
                        <td class="py-3 px-6">{{ $order->address }}</td>
                        <td class="py-3 px-6">{{ $order->city }}</td>
                        <td class="py-3 px-6">{{ $order->pin }}</td>
                    </tr>

                    <!-- Order Items -->
                    <tr class="bg-indigo-50 border border-indigo-200">
                        <td colspan="8" class="py-4 px-6">
                            <div class="ml-4">
                                <h3 class="font-semibold mb-3 text-indigo-700 text-lg">Items:</h3>
                                <table
                                    class="w-full text-sm text-left text-gray-700 border border-gray-300 rounded-md overflow-hidden">
                                    <thead
                                        class="bg-indigo-200 text-indigo-900 uppercase text-xs font-semibold tracking-wide">
                                        <tr>
                                            <th class="py-2 px-4 border-r border-indigo-300">Product Name</th>
                                            <th class="py-2 px-4 border-r border-indigo-300">Quantity</th>
                                            <th class="py-2 px-4 border-r border-indigo-300">Size</th>
                                            <th class="py-2 px-4 border-r border-indigo-300">Price</th>
                                            <th class="py-2 px-4 border-r border-indigo-300">Discount</th>
                                            <th class="py-2 px-4 border-r border-indigo-300">Final Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            @if ($item->product && $item->product->prices->count())
                                                @php
                                                    // Bulk orders collection from product relation
                                                    $bulk = $item->product->bulkOrders
                                                        ->where('bulk_order_quantity', '<=', $item->quantity)
                                                        ->sortByDesc('bulk_order_quantity')
                                                        ->first();

                                                    // Agar bulk order applicable hai toh bulk price lein warna discount price
                                                    $finalPrice = $bulk
                                                        ? $bulk->price
                                                        : ($item->product->prices->first()->discount > 0
                                                            ? $item->product->prices->first()->price *
                                                                (1 - $item->product->prices->first()->discount / 100)
                                                            : $item->product->prices->first()->price);
                                                @endphp

                                                <tr
                                                    class="border-b border-gray-300 hover:bg-indigo-100 transition-colors duration-150">
                                                    <td class="py-2 px-4 border-r border-indigo-300 font-medium">
                                                        {{ $item->product->name ?? 'Unknown Product' }}
                                                    </td>
                                                    <td class="py-2 px-4 border-r border-indigo-300">
                                                        {{ $item->quantity }}
                                                    </td>
                                                    <td class="py-2 px-4 border-r border-indigo-300">
                                                        {{ $item->product->prices->first()->size ?? 'N/A' }}
                                                    </td>
                                                    <td class="py-2 px-4 border-r border-indigo-300">
                                                        ₹{{ number_format($item->product->prices->first()->price, 2) }}
                                                    </td>
                                                    <td class="py-2 px-4 border-r border-indigo-300">
                                                        @if ($bulk)
                                                            <span class="text-blue-600 font-semibold">Bulk</span>
                                                        @elseif ($item->product->prices->first()->discount > 0)
                                                            <span class="text-green-600 font-semibold">
                                                                {{ number_format($item->product->prices->first()->discount, 0) }}%
                                                            </span>
                                                        @else
                                                            <span class="text-gray-400 italic">None</span>
                                                        @endif
                                                    </td>
                                                    <td class="py-2 px-4 border-r border-indigo-300">
                                                        ₹{{ number_format($finalPrice, 2) }}
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="border-b border-gray-300">
                                                    <td class="py-2 px-4 italic text-gray-500" colspan="6">
                                                        {{ $item->product->name ?? 'Unknown Product' }} — No price info
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        <tr class="bg-indigo-100 font-semibold text-indigo-800">
                                            <td colspan="3" class="py-3 px-4 border-t border-indigo-300">GST:</td>
                                            <td class="py-3 px-4 border-t border-indigo-300">
                                                ₹{{ number_format($order->gst, 2) }}</td>
                                            <td colspan="2" class="py-3 px-4 border-t border-indigo-300"></td>
                                        </tr>
                                        <tr class="bg-indigo-100 font-semibold text-indigo-800">
                                            <td colspan="3" class="py-3 px-4 border-t border-indigo-300">Total:</td>
                                            <td class="py-3 px-4 border-t border-indigo-300">
                                                ₹{{ number_format($order->total ?? 0, 2) }}</td>
                                            <td colspan="2" class="py-3 px-4 border-t border-indigo-300"></td>
                                        </tr>
                                        <tr class="bg-indigo-100 font-semibold text-indigo-800">
                                            <td colspan="3" class="py-3 px-4 border-t border-indigo-300">Payment
                                                Method:</td>
                                            <td class="py-3 px-4 border-t border-indigo-300">
                                                {{ strtoupper($order->payment_method) }}
                                            </td>
                                            <td colspan="2" class="py-3 px-4 border-t border-indigo-300"></td>
                                        </tr>
                                        <tr x-data="{ openModal: false }" class="bg-indigo-100 font-semibold text-indigo-800">
                                            <td colspan="3" class="py-3 px-4 border-t border-indigo-300">Screenshot:
                                            </td>
                                            <td class="py-3 px-4 border-t border-indigo-300" colspan="3">
                                                @if ($order->screenshot)
                                                    <!-- Thumbnail -->
                                                    <img src="{{ asset('storage/' . $order->screenshot) }}"
                                                        alt="Screenshot"
                                                        class="w-24 h-24 rounded-md shadow-sm hover:scale-110 transition-transform duration-200 cursor-pointer"
                                                        @click="openModal = true">

                                                    <!-- Modal -->
                                                    <div x-show="openModal" x-cloak
                                                        class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                                                        @click.away="openModal = false"
                                                        @keydown.escape.window="openModal = false">

                                                        <div
                                                            class="bg-white rounded-lg overflow-hidden shadow-lg max-w-3xl w-full p-4">
                                                            <button
                                                                class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl font-bold"
                                                                @click="openModal = false">&times;</button>

                                                            <img src="{{ asset('storage/' . $order->screenshot) }}"
                                                                alt="Screenshot Full"
                                                                class="w-full max-h-[80vh] object-contain rounded">
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 italic">Cash On Delivery</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr class="bg-indigo-100 font-semibold text-indigo-800">
                                            <td colspan="3" class="py-3 px-4 border-t border-indigo-300">Date:</td>
                                            <td class="py-3 px-4 border-t border-indigo-300">
                                                {{ $order->created_at->format('d M Y') }}</td>
                                            <td colspan="2" class="py-3 px-4 border-t border-indigo-300"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
