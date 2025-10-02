{{-- resources/views/layouts/navbar.blade.php --}}
<nav class="w-full bg-[#ffbdbd] shadow-md" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Left: Logo -->
        <div class="flex-shrink-0">
            <a href="/dashboard" class="text-4xl font-bold text-black" style="font-family: 'Lora', serif;">Élan</a>
        </div>

        <!-- Center: Navigation Links (Desktop) -->
        <ul class="hidden md:flex space-x-14 text-black text-l mx-auto" style="font-family: 'Lora', serif;">
            <li><a href="/dashboard" class="px-3 py-2 rounded-md hover:bg-white hover:text-[#db9289] transition">HOME</a></li>
            <li><a href="{{ route('component.shop') }}" class="px-3 py-2 rounded-md hover:bg-white hover:text-[#db9289] transition">SHOP</a></li>

            <!-- Categories Dropdown -->
            <li x-data="{ openCat: false }" class="relative">
                <button @click="openCat = !openCat" class="flex items-center space-x-1 hover:text-[#db9289] focus:outline-none">
                    <span>CATEGORIES</span>
                    <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul x-cloak x-show="openCat" @click.outside="openCat = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="absolute bg-white shadow-lg rounded-md mt-2 py-2 w-56 z-50">
                    <li><a href="{{ route('user.shop.acne') }}" class="block px-4 py-2 hover:bg-[#ffbdbd]">Acne</a></li>
                    <li><a href="{{ route('user.shop.hyperpigmentation') }}" class="block px-4 py-2 hover:bg-[#ffbdbd]">Hyperpigmentation</a></li>
                    <li><a href="{{ route('user.shop.brightening') }}" class="block px-4 py-2 hover:bg-[#ffbdbd]">Brightening</a></li>
                    <li><a href="{{ route('user.shop.cleanser') }}" class="block px-4 py-2 hover:bg-[#ffbdbd]">Cleanser & Makeup Remover</a></li>
                    <li><a href="{{ route('user.shop.moisturizer') }}" class="block px-4 py-2 hover:bg-[#ffbdbd]">Moisturizer</a></li>
                    <li><a href="{{ route('user.shop.makeup') }}" class="block px-4 py-2 hover:bg-[#ffbdbd]">Makeup</a></li>
                </ul>
            </li>

            <li><a href="{{ route('about') }}" class="px-3 py-2 rounded-md hover:bg-white hover:text-[#db9289] transition">ABOUT US</a></li>
            <li><a href="{{ route('contact') }}"class="px-3 py-2 rounded-md hover:bg-white hover:text-[#db9289] transition">CONTACT US</a></li>
        </ul>

        <!-- Right-side Icons: Favourite + Cart + Profile (Desktop & Tablet) -->
        <div class="hidden sm:flex sm:items-center sm:space-x-4 ms-4">
            <!-- Favourite Icon -->
            <a href="{{ route('user.favourites') }}" class="text-gray-700 hover:text-[#db9289] transition relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                </svg>
            </a>

            <!-- Cart Icon -->
            <a href="{{ route('user.cart') }}" class="text-gray-700 hover:text-[#db9289] transition relative">
                @livewire('cart-counter')
            </a>

            <!-- Right: Jetstream Account Management -->
    <div class="hidden sm:flex sm:items-center sm:ms-6">
      @auth
          @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
              <div class="ms-3 relative">
                  <x-dropdown align="right" width="60">
                      <x-slot name="trigger">
                          <span class="inline-flex rounded-md">
                              <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent 
                                  text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-[#db9289] 
                                  focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                  {{ Auth::user()->currentTeam->name }}
                                  <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" 
                                      viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" 
                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                  </svg>
                              </button>
                          </span>
                      </x-slot>

                      <x-slot name="content">
                          <div class="w-60">
                              <!-- Team Management -->
                              <div class="block px-4 py-2 text-xs text-gray-400">
                                  {{ __('Manage Team') }}
                              </div>
                              <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                  {{ __('Team Settings') }}
                              </x-dropdown-link>
                              @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                  <x-dropdown-link href="{{ route('teams.create') }}">
                                      {{ __('Create New Team') }}
                                  </x-dropdown-link>
                              @endcan

                              @if (Auth::user()->allTeams()->count() > 1)
                                  <div class="border-t border-gray-200"></div>
                                  <div class="block px-4 py-2 text-xs text-gray-400">
                                      {{ __('Switch Teams') }}
                                  </div>
                                  @foreach (Auth::user()->allTeams() as $team)
                                      <x-switchable-team :team="$team" />
                                  @endforeach
                              @endif
                          </div>
                      </x-slot>
                  </x-dropdown>
              </div>
          @endif

          <!-- Profile -->
          <div class="ms-3 relative">
              <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                      @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                          <button class="flex text-sm border-2 border-transparent rounded-full 
                              focus:outline-none focus:border-gray-300 transition">
                              <img class="size-8 rounded-full object-cover" 
                                  src="{{ Auth::user()->profile_photo_url }}" 
                                  alt="{{ Auth::user()->name }}" />
                          </button>
                      @else
                          <span class="inline-flex rounded-md">
                              <button type="button" 
                                  class="inline-flex items-center px-3 py-2 border border-transparent 
                                  text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-[#db9289] 
                                  focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                  {{ Auth::user()->name }}
                                  <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" 
                                      fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" 
                                          d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                  </svg>
                              </button>
                          </span>
                      @endif
                  </x-slot>

                  <x-slot name="content">
                      <div class="block px-4 py-2 text-xs text-gray-400">
                          {{ __('Manage Account') }}
                      </div>
                      <x-dropdown-link href="{{ route('profile.show') }}">
                          {{ __('Profile') }}
                      </x-dropdown-link>
                      @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                          <x-dropdown-link href="{{ route('api-tokens.index') }}">
                              {{ __('API Tokens') }}
                          </x-dropdown-link>
                      @endif
                      <div class="border-t border-gray-200"></div>
                      <form method="POST" action="{{ route('logout') }}" x-data>
                          @csrf
                          <x-dropdown-link href="{{ route('logout') }}"
                              @click.prevent="$root.submit();">
                              {{ __('Log Out') }}
                          </x-dropdown-link>
                      </form>
                  </x-slot>
              </x-dropdown>
          </div>
      @else
      @endauth
    </div>
        </div>

        <!-- Hamburger (Mobile) -->
        <div class="flex sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-[#db9289] hover:bg-gray-100 focus:outline-none transition">
                <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

    </div>

    <!-- Mobile Menu -->
    <div x-cloak x-show="open" class="sm:hidden bg-white shadow-md">
        <ul class="px-2 pt-2 pb-3 space-y-1">
            <li><a href="/dashboard" class="block px-3 py-2 rounded-md hover:bg-[#ffbdbd]">HOME</a></li>
            <li><a href="{{ route('component.shop') }}" class="block px-3 py-2 rounded-md hover:bg-[#ffbdbd]">SHOP</a></li>
            <li><a href="/about" class="block px-3 py-2 rounded-md hover:bg-[#ffbdbd]">ABOUT US</a></li>
            <li><a href="/contact" class="block px-3 py-2 rounded-md hover:bg-[#ffbdbd]">CONTACT US</a></li>
            <li class="flex items-center space-x-4 px-3 py-2">
                <a href="{{ route('user.favourites') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                    </svg>
                </a>
                <a href="{{ route('user.cart') }}">
                    @livewire('cart-counter')
                </a>
            </li>
        </ul>
    </div>

</nav>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@livewireScripts
