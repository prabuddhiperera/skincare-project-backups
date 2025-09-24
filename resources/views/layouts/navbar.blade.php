<!-- Navbar -->
<nav class="w-full bg-[#ffbdbd] shadow-md">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

    <!-- Left: Logo -->
    <div class="flex-shrink-0">
      <a href="/" class="text-4xl font-bold text-black" style="font-family: 'Lora', serif;">Élan</a>
    </div>

    <!-- Center: Navigation Links -->
    <ul class="hidden md:flex space-x-14 text-black text-l mx-auto" style="font-family: 'Lora', serif;">
      <li><a href="/" class="px-3 py-2 rounded-md hover:bg-white hover:text-[#db9289] transition">HOME</a></li>
      <li><a href="/shop" class="px-3 py-2 rounded-md hover:bg-white hover:text-[#db9289] transition">SHOP</a></li>

      <!-- Categories Dropdown with Alpine.js -->
      <li x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="flex items-center space-x-1 hover:text-[#db9289] focus:outline-none">
          <span>CATEGORIES</span>
          <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <ul x-show="open" @click.away="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="absolute bg-white shadow-lg rounded-md mt-2 py-2 w-56 z-50">
          <li><a href="/categories/acne" class="block px-4 py-2 hover:bg-[#ffbdbd]">Acne</a></li>
          <li><a href="/categories/hyperpigmentation" class="block px-4 py-2 hover:bg-[#ffbdbd]">Hyperpigmentation</a></li>
          <li><a href="/categories/brightening" class="block px-4 py-2 hover:bg-[#ffbdbd]">Brightening</a></li>
          <li><a href="/categories/cleanser" class="block px-4 py-2 hover:bg-[#ffbdbd]">Cleanser & Makeup Remover</a></li>
          <li><a href="/categories/moisturizer" class="block px-4 py-2 hover:bg-[#ffbdbd]">Moisturizer</a></li>
          <li><a href="/categories/makeup" class="block px-4 py-2 hover:bg-[#ffbdbd]">Makeup</a></li>
        </ul>
      </li>

      <li><a href="/about" class="px-3 py-2 rounded-md hover:bg-white hover:text-[#db9289] transition">ABOUT US</a></li>
      <li><a href="/contact" class="px-3 py-2 rounded-md hover:bg-white hover:text-[#db9289] transition">CONTACT US</a></li>
    </ul>

    <!-- Right: Login/Register -->
    <div class="flex items-center space-x-5">
      <a href="{{ route('login') }}" class="inline-block text-sm text-[#db9289] border border-[#f3c4c1] bg-white hover:bg-[#db9289] hover:text-white font-semibold py-2 px-4 rounded transition duration-300">
        Login
      </a>
      <a href="{{ route('register') }}" class="inline-block text-sm text-[#db9289] border border-[#f3c4c1] bg-white hover:bg-[#db9289] hover:text-white font-semibold py-2 px-4 rounded transition duration-300">
        Register
      </a>
    </div>

  </div>
</nav>

<!-- Include Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
