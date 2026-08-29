<!DOCTYPE html>

<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="dark"
>
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <flux:sidebar
        sticky
        collapsible="mobile"
        class="
            border-e border-zinc-200
            bg-zinc-50
            dark:border-zinc-700
            dark:bg-zinc-900
        "
    >

        {{-- Sidebar Header --}}
        <flux:sidebar.header>

            <x-app-logo
                :sidebar="true"
                href="{{ route('dashboard') }}"
                wire:navigate
            />

            <flux:sidebar.collapse
                class="lg:hidden"
            />

        </flux:sidebar.header>


        {{-- Main Navigation --}}
        <flux:sidebar.nav>

            <flux:sidebar.group
                :heading="__('Management')"
                class="grid"
            >

                {{-- Dashboard --}}
                <flux:sidebar.item
                    icon="home"
                    :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')"
                    wire:navigate
                >
                    {{ __('Dashboard') }}
                </flux:sidebar.item>


                {{-- Equipment --}}
                <flux:sidebar.item
                    icon="cube"
                    :href="route('equipment.index')"
                    :current="request()->routeIs('equipment.*')"
                    wire:navigate
                >
                    {{ __('Equipment') }}
                </flux:sidebar.item>


                {{-- Rentals --}}
                <flux:sidebar.item
                    icon="clipboard-document-list"
                    :href="route('rentals.index')"
                    :current="request()->routeIs('rentals.*')"
                    wire:navigate
                >
                    {{ __('Rentals') }}
                </flux:sidebar.item>


                {{-- Customers --}}
                <flux:sidebar.item
                    icon="users"
                    :href="route('customers.index')"
                    :current="request()->routeIs('customers.*')"
                    wire:navigate
                >
                    {{ __('Customers') }}
                </flux:sidebar.item>

            </flux:sidebar.group>

        </flux:sidebar.nav>


        {{-- Push user menu to bottom --}}
        <flux:spacer />


        {{-- Desktop User Menu --}}
        <x-desktop-user-menu
            class="hidden lg:block"
            :name="auth()->user()->name"
        />

    </flux:sidebar>


    {{-- Mobile Header --}}
    <flux:header class="lg:hidden">

        <flux:sidebar.toggle
            class="lg:hidden"
            icon="bars-2"
            inset="left"
        />

        <flux:spacer />


        {{-- Mobile User Menu --}}
        <flux:dropdown
            position="top"
            align="end"
        >

            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />


            <flux:menu>

                {{-- User Information --}}
                <flux:menu.radio.group>

                    <div class="p-0 text-sm font-normal">

                        <div
                            class="
                                flex items-center gap-2
                                px-1 py-1.5
                                text-start text-sm
                            "
                        >

                            <flux:avatar
                                :name="auth()->user()->name"
                                :initials="auth()->user()->initials()"
                            />


                            <div
                                class="
                                    grid flex-1
                                    text-start text-sm
                                    leading-tight
                                "
                            >

                                <flux:heading class="truncate">
                                    {{ auth()->user()->name }}
                                </flux:heading>

                                <flux:text class="truncate">
                                    {{ auth()->user()->email }}
                                </flux:text>

                            </div>

                        </div>

                    </div>

                </flux:menu.radio.group>


                <flux:menu.separator />


                {{-- Settings --}}
                <flux:menu.radio.group>

                    <flux:menu.item
                        :href="route('profile.edit')"
                        icon="cog"
                        wire:navigate
                    >
                        {{ __('Settings') }}
                    </flux:menu.item>

                </flux:menu.radio.group>


                <flux:menu.separator />


                {{-- Logout --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="w-full"
                >

                    @csrf

                    <flux:menu.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer"
                        data-test="logout-button"
                    >
                        {{ __('Log out') }}
                    </flux:menu.item>

                </form>

            </flux:menu>

        </flux:dropdown>

    </flux:header>


    {{-- Page Content --}}
    {{ $slot }}


    {{-- Toast --}}
    @persist('toast')

        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>

    @endpersist


    @fluxScripts

</body>

</html>