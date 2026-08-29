<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Rental Store' }}</title>
    @fluxAppearance

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @livewireStyles
</head>

<body
    class="
        min-h-screen
        bg-gray-100 text-gray-900
        transition-colors
        dark:bg-gray-950 dark:text-gray-100
    "
>

    <nav
        x-data="{ open: false }"
        class="
            border-b border-gray-200
            bg-white
            dark:border-gray-800
            dark:bg-gray-900
        "
    >

        {{-- Main Navbar --}}
        <div
            class="
                mx-auto flex max-w-7xl
                items-center justify-between
                px-4 py-4
                sm:px-6
                lg:px-8
            "
        >

            {{-- Brand --}}
            <a
                href="{{ route('home') }}"
                class="block"
            >
                <h1
                    class="
                        text-lg font-bold
                        text-gray-900
                        sm:text-xl
                        dark:text-white
                    "
                >
                    Rental Store
                </h1>

                <p
                    class="
                        text-xs text-gray-500
                        sm:text-sm
                        dark:text-gray-400
                    "
                >
                    Equipment Rental
                </p>
            </a>


            {{-- Desktop Navigation --}}
            <div
                class="
                    hidden items-center gap-6
                    md:flex
                "
            >

                {{-- Store --}}
                <a
                    href="{{ route('customer.store') }}"
                    wire:navigate
                    class="
                        text-sm font-medium
                        transition-colors
                        {{ request()->routeIs('customer.store')
                            ? 'text-gray-900 dark:text-white'
                            : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white'
                        }}
                    "
                >
                    Store
                </a>


                @auth('customer')

                    <a
                        href="{{ route('customer.rentals') }}"
                        wire:navigate
                        class="
                            text-sm font-medium
                            transition-colors
                            {{ request()->routeIs('customer.rentals')
                                ? 'text-gray-900 dark:text-white'
                                : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white'
                            }}
                        "
                    >
                        My Rentals
                    </a>


                    <a
                        href="{{ route('customer.profile') }}"
                        wire:navigate
                        class="
                            text-sm font-medium
                            transition-colors
                            {{ request()->routeIs('customer.profile')
                                ? 'text-gray-900 dark:text-white'
                                : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white'
                            }}
                        "
                    >
                        Profile
                    </a>


                    <div
                        class="
                            h-6 border-l
                            border-gray-200
                            dark:border-gray-700
                        "
                    ></div>


                    <span
                        class="
                            max-w-40 truncate
                            text-sm text-gray-600
                            dark:text-gray-300
                        "
                    >
                        {{ auth('customer')->user()->name }}
                    </span>


                    <form
                        method="POST"
                        action="{{ route('customer.logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="
                                text-sm font-medium
                                text-gray-500
                                transition-colors
                                hover:text-gray-900
                                dark:text-gray-400
                                dark:hover:text-white
                            "
                        >
                            Logout
                        </button>
                    </form>


                @else

                    <div
                        class="
                            h-6 border-l
                            border-gray-200
                            dark:border-gray-700
                        "
                    ></div>


                    <a
                        href="{{ route('customer.login') }}"
                        class="
                            text-sm font-medium
                            text-gray-600
                            transition-colors
                            hover:text-gray-900
                            dark:text-gray-300
                            dark:hover:text-white
                        "
                    >
                        Sign In
                    </a>


                    <a
                        href="{{ route('customer.register') }}"
                        class="
                            rounded-lg
                            bg-gray-900
                            px-4 py-2
                            text-sm font-medium
                            text-white
                            transition-colors
                            hover:bg-gray-800
                            dark:bg-white
                            dark:text-gray-900
                            dark:hover:bg-gray-200
                        "
                    >
                        Register
                    </a>

                @endauth

            </div>


            {{-- Mobile Menu Button --}}
            <button
                type="button"
                @click="open = !open"
                class="
                    inline-flex items-center justify-center
                    rounded-lg
                    border border-gray-200
                    p-2
                    text-gray-600
                    transition
                    hover:bg-gray-100
                    md:hidden
                    dark:border-gray-700
                    dark:text-gray-300
                    dark:hover:bg-gray-800
                "
                aria-label="Toggle navigation"
            >
                {{-- Menu Icon --}}
                <svg
                    x-show="!open"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-6 w-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                    />
                </svg>

                {{-- Close Icon --}}
                <svg
                    x-show="open"
                    x-cloak
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-6 w-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>


        {{-- Mobile Navigation --}}
        <div
            x-show="open"
            x-cloak
            x-transition
            class="
                border-t border-gray-200
                px-4 py-4
                md:hidden
                dark:border-gray-800
            "
        >

            <div class="flex flex-col gap-1">

                <a
                    href="{{ route('customer.store') }}"
                    wire:navigate
                    class="
                        rounded-lg
                        px-3 py-2.5
                        text-sm font-medium
                        transition-colors
                        {{ request()->routeIs('customer.store')
                            ? 'bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white'
                        }}
                    "
                >
                    Store
                </a>


                @auth('customer')

                    <a
                        href="{{ route('customer.rentals') }}"
                        wire:navigate
                        class="
                            rounded-lg
                            px-3 py-2.5
                            text-sm font-medium
                            transition-colors
                            {{ request()->routeIs('customer.rentals')
                                ? 'bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white'
                            }}
                        "
                    >
                        My Rentals
                    </a>


                    <a
                        href="{{ route('customer.profile') }}"
                        wire:navigate
                        class="
                            rounded-lg
                            px-3 py-2.5
                            text-sm font-medium
                            transition-colors
                            {{ request()->routeIs('customer.profile')
                                ? 'bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white'
                            }}
                        "
                    >
                        Profile
                    </a>


                    <div
                        class="
                            my-2 border-t
                            border-gray-200
                            dark:border-gray-800
                        "
                    ></div>


                    <div
                        class="
                            px-3 py-2
                            text-sm text-gray-500
                            dark:text-gray-400
                        "
                    >
                        Signed in as

                        <span
                            class="
                                block truncate
                                font-medium
                                text-gray-900
                                dark:text-white
                            "
                        >
                            {{ auth('customer')->user()->name }}
                        </span>
                    </div>


                    <form
                        method="POST"
                        action="{{ route('customer.logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="
                                w-full rounded-lg
                                px-3 py-2.5
                                text-left
                                text-sm font-medium
                                text-red-600
                                transition-colors
                                hover:bg-red-50
                                dark:text-red-400
                                dark:hover:bg-red-950/40
                            "
                        >
                            Logout
                        </button>
                    </form>


                @else

                    <div
                        class="
                            my-2 border-t
                            border-gray-200
                            dark:border-gray-800
                        "
                    ></div>


                    <a
                        href="{{ route('customer.login') }}"
                        class="
                            rounded-lg
                            px-3 py-2.5
                            text-sm font-medium
                            text-gray-600
                            transition-colors
                            hover:bg-gray-100
                            hover:text-gray-900
                            dark:text-gray-300
                            dark:hover:bg-gray-800
                            dark:hover:text-white
                        "
                    >
                        Sign In
                    </a>


                    <a
                        href="{{ route('customer.register') }}"
                        class="
                            mt-1 rounded-lg
                            bg-gray-900
                            px-3 py-2.5
                            text-center
                            text-sm font-medium
                            text-white
                            transition-colors
                            hover:bg-gray-800
                            dark:bg-white
                            dark:text-gray-900
                            dark:hover:bg-gray-200
                        "
                    >
                        Register
                    </a>

                @endauth

            </div>

        </div>

    </nav>


    <main class="min-h-[calc(100vh-81px)]">
        {{ $slot }}
    </main>

    @fluxScripts
    @livewireScripts
</body>
</html>