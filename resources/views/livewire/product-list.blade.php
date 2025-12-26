<div class="p-8 bg-white rounded-xl shadow-lg">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Products</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300">

            <div>
                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-5"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-5"
                        @transitionend="show === false && $el.remove()"
                        class="fixed top-4 left-4 right-4 max-w-md mx-auto z-50 bg-green-600 text-white px-4 py-3 sm:px-6 sm:py-4 rounded-lg shadow-xl flex items-center justify-between pointer-events-auto">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm sm:text-base font-medium">{{ session('message') }}</span>
                        </div>
                        <button @click="show = false"
                            class="text-white hover:text-gray-200 focus:outline-none transition text-xl leading-none">
                            &times;
                        </button>
                    </div>
                @endif



                @if (session()->has('error'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-5"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-5"
                        @transitionend="show === false && $el.remove()"
                        class="fixed top-4 left-4 right-4 max-w-md mx-auto z-50 bg-red-600 text-white px-4 py-3 sm:px-6 sm:py-4 rounded-lg shadow-xl flex items-center justify-between pointer-events-auto">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm sm:text-base font-medium">{{ session('error') }}</span>
                        </div>
                        <button @click="show = false"
                            class="text-white hover:text-gray-200 focus:outline-none transition text-xl leading-none">
                            &times;
                        </button>
                    </div>
                @endif
            </div>

            <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-8 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                        Product
                    </th>
                    <th scope="col"
                        class="px-8 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                        Price
                    </th>
                    <th scope="col"
                        class="px-8 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                        Stock
                    </th>
                    <th scope="col"
                        class="px-8 py-4 text-right text-xs font-medium text-gray-600 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-8 py-6">
                            <div class="flex items-center">
                                {{-- <div class="flex-shrink-0 h-16 w-16">
                                    <!-- Placeholder image; replace src with actual product image if available -->
                                    <div
                                        class="h-16 w-16 rounded-lg bg-gray-200 border-2 border-dashed border-gray-400">
                                    </div>
                                </div> --}}
                                <div class="ml-4">
                                    <div class="text-base font-medium text-gray-900">{{ $product->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            @if ($product->stock_quantity > 0)
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $product->stock_quantity }} in stock
                                </span>
                            @else
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Out of stock
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            @if ($product->stock_quantity > 0)
                                <button wire:click="addToCart({{ $product->id }})"
                                    class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                    Add to Cart
                                </button>
                            @else
                                <button disabled
                                    class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center text-gray-500">
                            <p class="text-lg font-medium">No products found.</p>
                            <p class="mt-2 text-sm">Try adjusting your search criteria or check back later.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
