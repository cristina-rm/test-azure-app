<nav x-data="{ open: false }" class="bg-white sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 md:px-0">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-jet-application-mark class="block h-12 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                       Home
                    </x-jet-nav-link>

                    {{--@auth
                        <x-jet-nav-link href="{{ route('sessions') }}" :active="request()->routeIs('sessions|welcome')" class="{{ !in_array(request()->route()->getName(), ['welcome', 'sessions']) ? 'border-transparent' : 'border-b-2 border-primary font-bold focus:border-primary' }}">
                            @if(auth()->user()->hasRole(['Admin|User Manager|Trainer']))
                                Sessions
                            @else
                                My sessions
                            @endif
                        </x-jet-nav-link>
                    @endauth--}}
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    @auth
                                        {{ Auth::user()->name }}
                                    @else
                                        <i class="fas fa-user fa-2x"></i>
                                    @endauth

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            @auth
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-jet-dropdown-link :href="route('profile.show')" target="_blank">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                @hasanyrole('Admin|User Manager')
                                <x-jet-dropdown-link :href="url('/admin')" target="_blank">
                                    {{ __('Admin dashboard') }}
                                </x-jet-dropdown-link>
                                @endhasanyrole

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                         this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            @else
                                <x-jet-dropdown-link :href="route('login')">
                                    {{ __('Log In') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link :href="route('register')">
                                    {{ __('Register') }}
                                </x-jet-dropdown-link>
                            @endif
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 space-y-1">
            <!-- <x-jet-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link> -->

            {{--@auth
            <x-jet-responsive-nav-link href="{{ route('sessions') }}" :active="request()->routeIs('sessions|welcome')" class="{{ !in_array(request()->route()->getName(), ['welcome', 'sessions']) ? 'border-transparent' : 'border-b-2 border-primary font-bold focus:border-primary' }}">
                @if(auth()->user()->hasRole(['Admin|User Manager|Trainer']))
                    Sessions
                @else
                    My sessions
                @endif
            </x-jet-responsive-nav-link>
            @endauth--}}
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                @auth
                    <div class="font-medium text-base text-gray-800 ml-3">{{ Auth::user()->name }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                @auth
                    <x-jet-responsive-nav-link :href="route('profile.show')" target="_blank">
                        {{ __('Profile') }}
                    </x-jet-responsive-nav-link>

                    @hasanyrole('Admin|User Manager')
                    <x-jet-responsive-nav-link :href="url('/admin')" target="_blank">
                        {{ __('Admin dashboard') }}
                    </x-jet-responsive-nav-link>
                    @endhasanyrole

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link :href="route('logout')"
                               onclick="event.preventDefault();
                               this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-jet-responsive-nav-link>
                    </form>
                @else
                    <x-jet-responsive-nav-link :href="route('login')">
                        {{ __('Log In') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-jet-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
