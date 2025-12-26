<div>
    <a href="{{ route('cart.index') }}" wire:navigate
        class="relative inline-block text-left hover:opacity-80 transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-full">
        <!-- Shopping Cart Icon (using Heroicons-style SVG) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 hover:text-indigo-600 transition"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-label="View shopping cart">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>

        <!-- Badge showing total items (only visible if > 0) -->
        @if ($cartCount > 0)
            <span
                class="absolute -top-2 -right-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full min-w-[20px] h-6">
                {{ $cartCount }}
            </span>
        @endif
    </a>
</div>
