<nav x-data="{ open: false, openLogin:false, openRegister:false }" 
     class="bg-[#E1E5EB] border-b border-gray-300">

    <!-- MAIN NAV -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">

            {{-- LEFT: LOGO --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <x-application-logo class="h-10 w-10 text-gray-800" />
                    <span class="text-xl font-semibold">Evory</span>
                </a>
            </div>

            {{-- RIGHT LOGIN --}}
            <div class="hidden sm:flex items-center text-gray-700 gap-8 text-sm">
                {{-- CENTER MENU --}}
                <div class="hidden sm:flex gap-8 text-gray-700 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:text-black">Home</a>
                    <a href="#" class="hover:text-black">About</a>
                    <a href="#" class="hover:text-black">Events</a>
                    <a href="#" class="hover:text-black">Features</a>
                    <a href="#" class="hover:text-black">Booths</a>
                    <a href="#" class="hover:text-black">Contact Us</a>
                </div>

                @guest
                    <button 
                        @click="openLogin = true"
                        class="hover:text-black">
                        Log in
                    </button>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-700 hover:text-black">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="ml-1 w-4 h-4" fill="currentColor">
                                    <path d="M5.293 7.293L10 12l4.707-4.707-1.414-1.414L10 9.172 6.707 5.879z" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            {{-- MOBILE BUTTON --}}
            <div class="sm:hidden">
                <button @click="open = !open" 
                    class="p-2 rounded text-gray-700 hover:bg-gray-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor">
                        <path :class="{'hidden': open, 'block': !open }"
                            class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'block': open }"
                            class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-[#E1E5EB] px-6 pb-4">
        <div class="flex flex-col gap-3 text-gray-700 text-sm font-medium mt-3">

            <a href="{{ route('home') }}">Home</a>
            <a href="#">About</a>
            <a href="#">Events</a>
            <a href="#">Features</a>
            <a href="#">Booths</a>
            <a href="#">Contact Us</a>

            @guest
                <button 
                    @click="openLogin = true; open = false"
                    class="text-left">
                    Log in
                </button>
            @endguest

            @auth
                <a href="{{ route('profile.edit') }}">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-left w-full">Log Out</button>
                </form>
            @endauth
        </div>
    </div>

    {{-- POPUPS --}}
    @include('components.popups.login')
    @include('components.popups.register')

</nav>
