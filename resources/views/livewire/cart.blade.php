<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-10">Your Shopping Cart</h1>


        <div>
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-5" @transitionend="show === false && $el.remove()"
                    class="fixed top-4 left-4 right-4 max-w-md mx-auto z-50 bg-green-600 text-white px-4 py-3 sm:px-6 sm:py-4 rounded-lg shadow-xl flex items-center justify-between pointer-events-auto">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
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
                    x-transition:leave-end="opacity-0 -translate-y-5" @transitionend="show === false && $el.remove()"
                    class="fixed top-4 left-4 right-4 max-w-md mx-auto z-50 bg-red-600 text-white px-4 py-3 sm:px-6 sm:py-4 rounded-lg shadow-xl flex items-center justify-between pointer-events-auto">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
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

        @if ($cartItems->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="mx-auto h-32 w-32 text-gray-300 mb-8" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                </svg>
                <p class="text-2xl font-medium text-gray-700 mb-4">Your cart is empty</p>
                <p class="text-lg text-gray-500 mb-10">Looks like you haven't added any products yet.</p>
                <a href="{{ route('products') }}" wire:navigate
                    class="inline-flex items-center px-8 py-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow-md">
                    Continue Shopping
                </a>
            </div>
        @else
            <!-- Cart with Items -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow-lg divide-y divide-gray-200">
                        @foreach ($cartItems as $item)
                            <div
                                class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-8 hover:bg-gray-50 transition duration-200">
                                <!-- Product Info -->
                                <div class="flex items-center gap-6">
                                    {{-- <div class="flex-shrink-0">
                                        <!-- Placeholder image (replace with actual if available) -->
                                        <div
                                            class="h-32 w-32 bg-gray-200 rounded-xl border-2 border-dashed border-gray-300">
                                        </div>
                                    </div> --}}
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-lg text-gray-600 mt-1">
                                            ${{ number_format($item->product->price, 2) }}</p>
                                    </div>
                                </div>

                                <!-- Quantity & Actions -->
                                <div class="flex items-center gap-8">
                                    <!-- Quantity Selector with +/- -->
                                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                        <button type="button"
                                            wire:click="updateQty({{ $item->id }}, {{ $item->quantity - 1 }})"
                                            @if ($item->quantity <= 1) disabled @endif
                                            class="px-4 py-3 bg-gray-50 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                            -
                                        </button>
                                        <input type="number" value="{{ $item->quantity }}" readonly
                                            class="w-20 py-3 text-center font-medium text-gray-900 bg-white">
                                        <button type="button"
                                            wire:click="updateQty({{ $item->id }}, {{ $item->quantity + 1 }})"
                                            class="px-4 py-3 bg-gray-50 hover:bg-gray-100 transition">
                                            +
                                        </button>
                                    </div>

                                    <!-- Remove -->
                                    <button wire:click="remove({{ $item->id }})"
                                        class="text-red-600 hover:text-red-800 transition">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Item Total -->
                                <div class="text-right">
                                    <p class="text-xl font-bold text-gray-900">
                                        ${{ number_format($item->quantity * $item->product->price, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary (Sticky on Desktop) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-24">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        @php
                            $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
                        @endphp

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal</span>
                                <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Shipping</span>
                                <span class="font-medium">Free</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Tax</span>
                                <span class="font-medium">$0.00</span>
                            </div>
                        </div>

                        <div class="border-t pt-6">
                            <div class="flex justify-between text-2xl font-bold text-gray-900 mb-8">
                                <span>Total</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <button
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 rounded-lg transition shadow-md">
                                Proceed to Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
