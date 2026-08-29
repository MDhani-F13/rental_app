<x-layouts::app :title="__('Admin Dashboard')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <div>
            <flux:heading size="xl">
                Rental Management Dashboard
            </flux:heading>

            <flux:text class="mt-2">
                Manage your rental business from here.
            </flux:text>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-4">

            {{-- Equipment --}}
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <flux:text>Equipment</flux:text>

                <flux:heading size="xl" class="mt-2">
                    0
                </flux:heading>

                <flux:text class="mt-1">
                    Total equipment
                </flux:text>
            </div>

            {{-- Customers --}}
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <flux:text>Customers</flux:text>

                <flux:heading size="xl" class="mt-2">
                    0
                </flux:heading>

                <flux:text class="mt-1">
                    Registered customers
                </flux:text>
            </div>

            {{-- Active Rentals --}}
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <flux:text>Active Rentals</flux:text>

                <flux:heading size="xl" class="mt-2">
                    0
                </flux:heading>

                <flux:text class="mt-1">
                    Currently rented
                </flux:text>
            </div>

            {{-- Overdue --}}
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <flux:text>Overdue</flux:text>

                <flux:heading size="xl" class="mt-2">
                    0
                </flux:heading>

                <flux:text class="mt-1">
                    Overdue rentals
                </flux:text>
            </div>

        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">

            <flux:heading size="lg">
                Recent Rentals
            </flux:heading>

            <flux:text class="mt-2">
                Recent rental activity will appear here.
            </flux:text>

        </div>

    </div>

</x-layouts.app>