@props([
    'sidebar' => false,
])

@if ($sidebar)

    <flux:sidebar.brand
        :name="config('app.name', 'RentalApp')"
        {{ $attributes }}
    >
        <x-slot
            name="logo"
            class="
                flex aspect-square size-9
                items-center justify-center
                rounded-lg
            "
        >
            <x-app-logo-icon class="size-8" />
        </x-slot>
    </flux:sidebar.brand>

@else

    <flux:brand
        :name="config('app.name', 'RentalApp')"
        {{ $attributes }}
    >
        <x-slot
            name="logo"
            class="
                flex aspect-square size-9
                items-center justify-center
                rounded-lg
            "
        >
            <x-app-logo-icon class="size-8" />
        </x-slot>
    </flux:brand>

@endif