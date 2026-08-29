<!DOCTYPE html>

<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="scroll-smooth"
>

<head>
    @include('partials.head')
    @fluxAppearance
</head>

<body class="bg-white text-gray-900 dark:bg-zinc-950 dark:text-zinc-100">

    {{-- ========================================================= --}}
    {{-- Navigation --}}
    {{-- ========================================================= --}}

    <header
        x-data="{ mobileMenuOpen: false }"
        class="
            sticky top-0 z-50
            border-b border-gray-200
            bg-white/90
            backdrop-blur
            dark:border-zinc-800
            dark:bg-zinc-950/90
        "
    >
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900 dark:text-white">
                RentalApp
            </a>

            <div class="hidden items-center gap-7 md:flex">
                <nav class="flex items-center gap-6">
                    <a href="{{ route('customer.store') }}" class="text-sm font-medium text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                        Browse Equipment
                    </a>

                    @auth('customer')
                        <a href="{{ route('customer.rentals') }}" class="text-sm font-medium text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">My Rentals</a>
                        <a href="{{ route('customer.profile') }}" class="text-sm font-medium text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">Profile</a>
                    @else
                        <a href="{{ route('customer.login') }}" class="text-sm font-medium text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">Sign In</a>
                        <a href="{{ route('customer.register') }}" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-gray-800 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-white">Register</a>
                    @endauth
                </nav>

                <div x-data class="flex items-center rounded-lg border border-gray-200 bg-gray-50 p-1 dark:border-zinc-800 dark:bg-zinc-900" aria-label="Appearance">
                    <button type="button" @click="$flux.appearance = 'light'" :class="$flux.appearance === 'light' ? 'bg-white text-gray-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white'" class="rounded-md px-2 py-1.5 text-xs font-medium transition">Light</button>
                    <button type="button" @click="$flux.appearance = 'dark'" :class="$flux.appearance === 'dark' ? 'bg-white text-gray-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white'" class="rounded-md px-2 py-1.5 text-xs font-medium transition">Dark</button>
                    <button type="button" @click="$flux.appearance = 'system'" :class="$flux.appearance === 'system' ? 'bg-white text-gray-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white'" class="rounded-md px-2 py-1.5 text-xs font-medium transition">System</button>
                </div>

                <div class="border-l border-gray-200 pl-6 dark:border-zinc-800">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">Admin Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">Admin</a>
                    @endauth
                </div>
            </div>

            <button
                type="button"
                @click="mobileMenuOpen = !mobileMenuOpen"
                :aria-expanded="mobileMenuOpen"
                aria-controls="mobile-navigation"
                aria-label="Toggle navigation"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-gray-700 transition hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900/10 md:hidden dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white dark:focus:ring-white/10"
            >
                <svg x-show="!mobileMenuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-5 w-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <svg x-show="mobileMenuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-5 w-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div
            id="mobile-navigation"
            x-show="mobileMenuOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="-translate-y-2 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="-translate-y-2 opacity-0"
            @keydown.escape.window="mobileMenuOpen = false"
            class="border-t border-gray-200 bg-white md:hidden dark:border-zinc-800 dark:bg-zinc-950"
        >
            <div class="mx-auto max-w-7xl space-y-1 px-4 py-4 sm:px-6">
                <a href="{{ route('customer.store') }}" @click="mobileMenuOpen = false" class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white">Browse Equipment</a>

                @auth('customer')
                    <a href="{{ route('customer.rentals') }}" @click="mobileMenuOpen = false" class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white">My Rentals</a>
                    <a href="{{ route('customer.profile') }}" @click="mobileMenuOpen = false" class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white">Profile</a>
                @else
                    <a href="{{ route('customer.login') }}" @click="mobileMenuOpen = false" class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white">Sign In</a>
                    <a href="{{ route('customer.register') }}" @click="mobileMenuOpen = false" class="mt-2 flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-white">Create Account</a>
                @endauth

                <div class="mt-4 border-t border-gray-200 pt-4 dark:border-zinc-800">
                    <p class="px-3 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-zinc-500">Appearance</p>
                    <div x-data class="grid grid-cols-3 gap-1 rounded-lg border border-gray-200 bg-gray-50 p-1 dark:border-zinc-800 dark:bg-zinc-900">
                        <button type="button" @click="$flux.appearance = 'light'" :class="$flux.appearance === 'light' ? 'bg-white text-gray-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-gray-500 dark:text-zinc-400'" class="rounded-md px-3 py-2 text-sm font-medium transition">Light</button>
                        <button type="button" @click="$flux.appearance = 'dark'" :class="$flux.appearance === 'dark' ? 'bg-white text-gray-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-gray-500 dark:text-zinc-400'" class="rounded-md px-3 py-2 text-sm font-medium transition">Dark</button>
                        <button type="button" @click="$flux.appearance = 'system'" :class="$flux.appearance === 'system' ? 'bg-white text-gray-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-gray-500 dark:text-zinc-400'" class="rounded-md px-3 py-2 text-sm font-medium transition">System</button>
                    </div>
                </div>

                <div class="mt-4 border-t border-gray-200 pt-4 dark:border-zinc-800">
                    <p class="px-3 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-zinc-500">Administration</p>
                    @auth
                        <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false" class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900 dark:text-zinc-400 dark:hover:bg-zinc-900 dark:hover:text-white">Admin Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900 dark:text-zinc-400 dark:hover:bg-zinc-900 dark:hover:text-white">Admin Sign In</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>


    {{-- ========================================================= --}}
    {{-- Hero --}}
    {{-- ========================================================= --}}

    <section
        class="
            border-b border-gray-100 dark:border-zinc-800
            bg-gradient-to-b
            from-gray-50 to-white
            dark:from-zinc-900 dark:to-zinc-950
        "
    >

        <div
            class="
                mx-auto grid max-w-7xl
                items-center gap-12
                px-6 py-20
                lg:grid-cols-2
                lg:py-28
            "
        >

            {{-- Hero Content --}}
            <div>

                <span
                    class="
                        inline-flex rounded-full
                        bg-gray-100 dark:bg-zinc-800
                        px-3 py-1
                        text-sm font-medium
                        text-gray-600 dark:text-zinc-400
                    "
                >
                    Simple Equipment Rental
                </span>


                <h1
                    class="
                        mt-6
                        text-4xl font-bold
                        leading-tight
                        tracking-tight
                        text-gray-900 dark:text-zinc-100
                        sm:text-5xl
                        lg:text-6xl
                    "
                >
                    Rent the equipment
                    you need.
                </h1>


                <p
                    class="
                        mt-6 max-w-xl
                        text-lg leading-8
                        text-gray-600 dark:text-zinc-400
                    "
                >
                    Browse available equipment,
                    choose your rental dates,
                    and submit a request
                    in just a few steps.
                </p>


                <div
                    class="
                        mt-8 flex flex-col gap-3
                        sm:flex-row
                    "
                >

                    <a
                        href="{{ route('customer.store') }}"
                        class="
                            inline-flex items-center
                            justify-center
                            rounded-lg
                            bg-gray-900
                            px-6 py-3
                            text-sm font-semibold
                            text-white
                            transition
                            hover:bg-gray-800
                        "
                    >
                        Browse Equipment
                    </a>


                    @guest('customer')

                        <a
                            href="{{ route('customer.login') }}"
                            class="
                                inline-flex items-center
                                justify-center
                                rounded-lg
                                border border-gray-300 dark:border-zinc-700
                                bg-white
                                px-6 py-3
                                dark:bg-zinc-900
                                text-sm font-semibold
                                text-gray-700 dark:text-zinc-300
                                transition
                                hover:bg-gray-50 dark:hover:bg-zinc-800
                            "
                        >
                            Customer Sign In
                        </a>

                    @else

                        <a
                            href="{{ route('customer.rentals') }}"
                            class="
                                inline-flex items-center
                                justify-center
                                rounded-lg
                                border border-gray-300 dark:border-zinc-700
                                bg-white
                                px-6 py-3
                                dark:bg-zinc-900
                                text-sm font-semibold
                                text-gray-700 dark:text-zinc-300
                                transition
                                hover:bg-gray-50 dark:hover:bg-zinc-800
                            "
                        >
                            View My Rentals
                        </a>

                    @endguest

                </div>

            </div>


            {{-- Hero Visual --}}
            <div>

                <div
                    class="
                        rounded-3xl
                        border border-gray-200 dark:border-zinc-800
                        bg-white
                        p-6
                        dark:bg-zinc-900
                        shadow-xl
                        shadow-gray-200/60 dark:shadow-black/20
                    "
                >

                    <div
                        class="
                            rounded-2xl
                            bg-gray-100 dark:bg-zinc-800
                            p-8
                        "
                    >

                        <div
                            class="
                                flex aspect-[4/3]
                                items-center justify-center
                                rounded-xl
                                border border-dashed
                                border-gray-300 dark:border-zinc-700
                                bg-white
                                dark:bg-zinc-950
                            "
                        >

                            <div class="text-center">

                                <div
                                    class="
                                        mx-auto flex
                                        h-16 w-16
                                        items-center justify-center
                                        rounded-2xl
                                        bg-gray-900
                                        text-2xl
                                        text-white
                                    "
                                >
                                    📦
                                </div>

                                <p
                                    class="
                                        mt-4
                                        font-semibold
                                        text-gray-900 dark:text-zinc-100
                                    "
                                >
                                    Find the right equipment
                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-sm
                                        text-gray-500 dark:text-zinc-400
                                    "
                                >
                                    Search, select dates,
                                    and request your rental.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- How It Works --}}
    {{-- ========================================================= --}}

    <section class="py-20">

        <div class="mx-auto max-w-7xl px-6">

            <div class="max-w-2xl">

                <p
                    class="
                        text-sm font-semibold
                        uppercase tracking-wide
                        text-gray-500 dark:text-zinc-400
                    "
                >
                    How it works
                </p>


                <h2
                    class="
                        mt-3
                        text-3xl font-bold
                        tracking-tight
                        text-gray-900 dark:text-zinc-100
                    "
                >
                    Renting equipment
                    doesn't need to be complicated.
                </h2>

            </div>


            <div
                class="
                    mt-12 grid gap-6
                    md:grid-cols-2
                    xl:grid-cols-4
                "
            >

                {{-- Step 1 --}}
                <div
                    class="
                        rounded-2xl
                        border border-gray-200 dark:border-zinc-800
                        bg-white
                        p-6
                        dark:bg-zinc-900
                    "
                >

                    <span
                        class="
                            text-sm font-bold
                            text-gray-400 dark:text-zinc-500
                        "
                    >
                        01
                    </span>

                    <h3
                        class="
                            mt-5 text-lg
                            font-semibold
                            text-gray-900 dark:text-zinc-100
                        "
                    >
                        Browse Equipment
                    </h3>

                    <p
                        class="
                            mt-3 text-sm
                            leading-6
                            text-gray-600 dark:text-zinc-400
                        "
                    >
                        Explore the equipment
                        available in the rental catalog.
                    </p>

                </div>


                {{-- Step 2 --}}
                <div
                    class="
                        rounded-2xl
                        border border-gray-200 dark:border-zinc-800
                        bg-white
                        p-6
                        dark:bg-zinc-900
                    "
                >

                    <span
                        class="
                            text-sm font-bold
                            text-gray-400 dark:text-zinc-500
                        "
                    >
                        02
                    </span>

                    <h3
                        class="
                            mt-5 text-lg
                            font-semibold
                            text-gray-900 dark:text-zinc-100
                        "
                    >
                        Choose Your Dates
                    </h3>

                    <p
                        class="
                            mt-3 text-sm
                            leading-6
                            text-gray-600 dark:text-zinc-400
                        "
                    >
                        Select your rental period
                        and the quantity you need.
                    </p>

                </div>


                {{-- Step 3 --}}
                <div
                    class="
                        rounded-2xl
                        border border-gray-200 dark:border-zinc-800
                        bg-white
                        p-6
                        dark:bg-zinc-900
                    "
                >

                    <span
                        class="
                            text-sm font-bold
                            text-gray-400 dark:text-zinc-500
                        "
                    >
                        03
                    </span>

                    <h3
                        class="
                            mt-5 text-lg
                            font-semibold
                            text-gray-900 dark:text-zinc-100
                        "
                    >
                        Submit Your Request
                    </h3>

                    <p
                        class="
                            mt-3 text-sm
                            leading-6
                            text-gray-600 dark:text-zinc-400
                        "
                    >
                        Send your rental request
                        and wait for approval.
                    </p>

                </div>


                {{-- Step 4 --}}
                <div
                    class="
                        rounded-2xl
                        border border-gray-200 dark:border-zinc-800
                        bg-white
                        p-6
                        dark:bg-zinc-900
                    "
                >

                    <span
                        class="
                            text-sm font-bold
                            text-gray-400 dark:text-zinc-500
                        "
                    >
                        04
                    </span>

                    <h3
                        class="
                            mt-5 text-lg
                            font-semibold
                            text-gray-900 dark:text-zinc-100
                        "
                    >
                        Rent & Return
                    </h3>

                    <p
                        class="
                            mt-3 text-sm
                            leading-6
                            text-gray-600 dark:text-zinc-400
                        "
                    >
                        Once approved,
                        use the equipment
                        and return it on time.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- Features --}}
    {{-- ========================================================= --}}

    <section
        class="
            border-y border-gray-100 dark:border-zinc-800
            bg-gray-50 dark:bg-zinc-900/50
            py-20
        "
    >

        <div class="mx-auto max-w-7xl px-6">

            <div class="text-center">

                <p
                    class="
                        text-sm font-semibold
                        uppercase tracking-wide
                        text-gray-500 dark:text-zinc-400
                    "
                >
                    Rental made simple
                </p>

                <h2
                    class="
                        mt-3 text-3xl font-bold
                        text-gray-900 dark:text-zinc-100
                    "
                >
                    Everything you need
                    in one place.
                </h2>

            </div>


            <div
                class="
                    mt-12 grid gap-6
                    md:grid-cols-3
                "
            >

                <div
                    class="
                        rounded-2xl
                        bg-white p-7
                        dark:bg-zinc-900
                        shadow-sm
                        ring-1 ring-gray-200 dark:ring-zinc-800
                    "
                >

                    <div
                        class="
                            flex h-11 w-11
                            items-center justify-center
                            rounded-xl
                            bg-gray-100 dark:bg-zinc-800
                            text-xl
                        "
                    >
                        📅
                    </div>

                    <h3
                        class="
                            mt-5
                            text-lg font-semibold
                            text-gray-900 dark:text-zinc-100
                        "
                    >
                        Flexible Rental Dates
                    </h3>

                    <p
                        class="
                            mt-2
                            text-sm leading-6
                            text-gray-600 dark:text-zinc-400
                        "
                    >
                        Choose the rental period
                        that works best for you.
                    </p>

                </div>


                <div
                    class="
                        rounded-2xl
                        bg-white p-7
                        dark:bg-zinc-900
                        shadow-sm
                        ring-1 ring-gray-200 dark:ring-zinc-800
                    "
                >

                    <div
                        class="
                            flex h-11 w-11
                            items-center justify-center
                            rounded-xl
                            bg-gray-100 dark:bg-zinc-800
                            text-xl
                        "
                    >
                        ✓
                    </div>

                    <h3
                        class="
                            mt-5
                            text-lg font-semibold
                            text-gray-900 dark:text-zinc-100
                        "
                    >
                        Date-Based Availability
                    </h3>

                    <p
                        class="
                            mt-2
                            text-sm leading-6
                            text-gray-600 dark:text-zinc-400
                        "
                    >
                        Availability is checked
                        based on the dates you select.
                    </p>

                </div>


                <div
                    class="
                        rounded-2xl
                        bg-white p-7
                        dark:bg-zinc-900
                        shadow-sm
                        ring-1 ring-gray-200 dark:ring-zinc-800
                    "
                >

                    <div
                        class="
                            flex h-11 w-11
                            items-center justify-center
                            rounded-xl
                            bg-gray-100 dark:bg-zinc-800
                            text-xl
                        "
                    >
                        📋
                    </div>

                    <h3
                        class="
                            mt-5
                            text-lg font-semibold
                            text-gray-900 dark:text-zinc-100
                        "
                    >
                        Track Your Rentals
                    </h3>

                    <p
                        class="
                            mt-2
                            text-sm leading-6
                            text-gray-600 dark:text-zinc-400
                        "
                    >
                        View pending, active,
                        late, returned,
                        and cancelled rentals.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- CTA --}}
    {{-- ========================================================= --}}

    <section class="py-20">

        <div class="mx-auto max-w-5xl px-6">

            <div
                class="
                    rounded-3xl
                    bg-gray-900
                    px-8 py-14
                    text-center
                    text-white
                    sm:px-12
                "
            >

                <h2
                    class="
                        text-3xl font-bold
                        tracking-tight
                    "
                >
                    Ready to find what you need?
                </h2>

                <p
                    class="
                        mx-auto mt-4
                        max-w-2xl
                        text-gray-300
                    "
                >
                    Browse the available equipment
                    and submit your rental request.
                </p>


                <div
                    class="
                        mt-8 flex flex-col
                        items-center justify-center
                        gap-3
                        sm:flex-row
                    "
                >

                    <a
                        href="{{ route('customer.store') }}"
                        class="
                            inline-flex items-center
                            justify-center
                            rounded-lg
                            bg-white
                            px-6 py-3
                            text-sm font-semibold
                            text-gray-900
                            transition
                            hover:bg-gray-100
                        "
                    >
                        Browse Equipment
                    </a>


                    @guest('customer')

                        <a
                            href="{{ route('customer.register') }}"
                            class="
                                inline-flex items-center
                                justify-center
                                rounded-lg
                                border border-gray-700
                                px-6 py-3
                                text-sm font-semibold
                                text-white
                                transition
                                hover:bg-gray-800
                            "
                        >
                            Create Account
                        </a>

                    @endguest

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- Footer --}}
    {{-- ========================================================= --}}

    <footer
        class="
            border-t border-gray-200 dark:border-zinc-800
            bg-white
            dark:bg-zinc-950
        "
    >

        <div
            class="
                mx-auto flex max-w-7xl
                flex-col gap-4
                px-6 py-8
                sm:flex-row
                sm:items-center
                sm:justify-between
            "
        >

            <div>

                <p
                    class="
                        font-semibold
                        text-gray-900 dark:text-zinc-100
                    "
                >
                    RentalApp
                </p>

                <p
                    class="
                        mt-1 text-sm
                        text-gray-500 dark:text-zinc-400
                    "
                >
                    Simple equipment rental management.
                </p>

            </div>


            <div
                class="
                    flex items-center gap-5
                    text-sm
                "
            >

                <a
                    href="{{ route('customer.store') }}"
                    class="
                        text-gray-500 dark:text-zinc-400
                        hover:text-gray-900 dark:hover:text-white
                    "
                >
                    Equipment
                </a>


                @guest('customer')

                    <a
                        href="{{ route('customer.login') }}"
                        class="
                            text-gray-500 dark:text-zinc-400
                            hover:text-gray-900 dark:hover:text-white
                        "
                    >
                        Customer Login
                    </a>

                @endguest


                @guest

                    <a
                        href="{{ route('login') }}"
                        class="
                            text-gray-400 dark:text-zinc-500
                            hover:text-gray-900 dark:hover:text-white
                        "
                    >
                        Admin
                    </a>

                @endguest

            </div>

        </div>

    </footer>

    @fluxScripts

</body>

</html>