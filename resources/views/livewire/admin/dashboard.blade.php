<div
    class="
        mx-auto max-w-7xl
        space-y-6
        px-4 py-6

        sm:space-y-8
        sm:px-6 sm:py-8

        lg:px-8 lg:py-10
    "
>

    {{-- ========================================================= --}}
    {{-- Header --}}
    {{-- ========================================================= --}}

    <div>

        <h1
            class="
                text-2xl font-bold
                text-gray-900

                sm:text-3xl

                dark:text-white
            "
        >
            Dashboard
        </h1>

        <p
            class="
                mt-2 text-sm
                text-gray-600

                sm:text-base

                dark:text-zinc-400
            "
        >
            Overview of your rental business and current activity.
        </p>

    </div>


    {{-- ========================================================= --}}
    {{-- Statistics --}}
    {{-- ========================================================= --}}

    <div
        class="
            grid gap-4

            sm:grid-cols-2
            sm:gap-5

            xl:grid-cols-3
        "
    >

        {{-- Customers --}}
        <a
            href="{{ route('customers.index') }}"
            wire:navigate
            class="
                rounded-xl
                bg-white p-5
                shadow-sm
                ring-1 ring-gray-200
                transition

                hover:-translate-y-0.5
                hover:shadow-md

                sm:p-6

                dark:bg-zinc-900
                dark:ring-zinc-700
            "
        >

            <p
                class="
                    text-sm font-medium
                    text-gray-500
                    dark:text-zinc-400
                "
            >
                Total Customers
            </p>

            <p
                class="
                    mt-3 text-3xl font-bold
                    text-gray-900
                    dark:text-white
                "
            >
                {{ number_format($totalCustomers) }}
            </p>

            <p
                class="
                    mt-2 text-xs
                    text-gray-400
                    dark:text-zinc-500
                "
            >
                Registered customer accounts
            </p>

        </a>


        {{-- Equipment Types --}}
        <a
            href="{{ route('equipment.index') }}"
            wire:navigate
            class="
                rounded-xl
                bg-white p-5
                shadow-sm
                ring-1 ring-gray-200
                transition

                hover:-translate-y-0.5
                hover:shadow-md

                sm:p-6

                dark:bg-zinc-900
                dark:ring-zinc-700
            "
        >

            <p
                class="
                    text-sm font-medium
                    text-gray-500
                    dark:text-zinc-400
                "
            >
                Equipment Types
            </p>

            <p
                class="
                    mt-3 text-3xl font-bold
                    text-gray-900
                    dark:text-white
                "
            >
                {{ number_format($totalEquipmentTypes) }}
            </p>

            <p
                class="
                    mt-2 text-xs
                    text-gray-400
                    dark:text-zinc-500
                "
            >
                Different equipment records
            </p>

        </a>


        {{-- Total Units --}}
        <a
            href="{{ route('equipment.index') }}"
            wire:navigate
            class="
                rounded-xl
                bg-white p-5
                shadow-sm
                ring-1 ring-gray-200
                transition

                hover:-translate-y-0.5
                hover:shadow-md

                sm:p-6

                dark:bg-zinc-900
                dark:ring-zinc-700
            "
        >

            <p
                class="
                    text-sm font-medium
                    text-gray-500
                    dark:text-zinc-400
                "
            >
                Total Equipment Units
            </p>

            <p
                class="
                    mt-3 text-3xl font-bold
                    text-gray-900
                    dark:text-white
                "
            >
                {{ number_format($totalEquipmentUnits) }}
            </p>

            <p
                class="
                    mt-2 text-xs
                    text-gray-400
                    dark:text-zinc-500
                "
            >
                Physical units owned
            </p>

        </a>


        {{-- Pending --}}
        <a
            href="{{ route('rentals.index', ['status' => 'Pending']) }}"
            wire:navigate
            class="
                rounded-xl
                border border-yellow-200
                bg-yellow-50
                p-5
                transition

                hover:-translate-y-0.5
                hover:shadow-md

                sm:p-6

                dark:border-yellow-900/50
                dark:bg-yellow-950/20
            "
        >

            <p
                class="
                    text-sm font-medium
                    text-yellow-700
                    dark:text-yellow-400
                "
            >
                Pending Requests
            </p>

            <p
                class="
                    mt-3 text-3xl font-bold
                    text-yellow-800
                    dark:text-yellow-300
                "
            >
                {{ number_format($pendingRentals) }}
            </p>

            <p
                class="
                    mt-2 text-xs
                    text-yellow-600
                    dark:text-yellow-500
                "
            >
                Waiting for admin approval
            </p>

        </a>


        {{-- Active --}}
        <a
            href="{{ route('rentals.index', ['status' => 'Rented']) }}"
            wire:navigate
            class="
                rounded-xl
                border border-blue-200
                bg-blue-50
                p-5
                transition

                hover:-translate-y-0.5
                hover:shadow-md

                sm:p-6

                dark:border-blue-900/50
                dark:bg-blue-950/20
            "
        >

            <p
                class="
                    text-sm font-medium
                    text-blue-700
                    dark:text-blue-400
                "
            >
                Active Rentals
            </p>

            <p
                class="
                    mt-3 text-3xl font-bold
                    text-blue-800
                    dark:text-blue-300
                "
            >
                {{ number_format($activeRentals) }}
            </p>

            <p
                class="
                    mt-2 text-xs
                    text-blue-600
                    dark:text-blue-500
                "
            >
                Equipment currently rented
            </p>

        </a>


        {{-- Late --}}
        <a
            href="{{ route('rentals.index', ['status' => 'Late']) }}"
            wire:navigate
            class="
                rounded-xl
                border border-red-200
                bg-red-50
                p-5
                transition

                hover:-translate-y-0.5
                hover:shadow-md

                sm:p-6

                dark:border-red-900/50
                dark:bg-red-950/20
            "
        >

            <div class="flex items-start justify-between gap-3">

                <div>

                    <p
                        class="
                            text-sm font-medium
                            text-red-700
                            dark:text-red-400
                        "
                    >
                        Late Rentals
                    </p>

                    <p
                        class="
                            mt-3 text-3xl font-bold
                            text-red-800
                            dark:text-red-300
                        "
                    >
                        {{ number_format($lateRentals) }}
                    </p>

                </div>


                @if ($lateRentals > 0)

                    <span
                        class="
                            shrink-0 rounded-full
                            bg-red-200
                            px-2.5 py-1
                            text-xs font-semibold
                            text-red-800

                            dark:bg-red-900/50
                            dark:text-red-300
                        "
                    >
                        Needs Attention
                    </span>

                @endif

            </div>

            <p
                class="
                    mt-2 text-xs
                    text-red-600
                    dark:text-red-500
                "
            >
                Past expected return date
            </p>

        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- Dashboard Detail Sections --}}
    {{-- ========================================================= --}}

    <div
        class="
            grid gap-6

            sm:gap-8

            xl:grid-cols-[minmax(0,2fr)_minmax(280px,1fr)]
        "
    >

        {{-- ===================================================== --}}
        {{-- Recent Rentals --}}
        {{-- ===================================================== --}}

        <section
            class="
                min-w-0
                overflow-hidden
                rounded-xl
                bg-white
                shadow-sm
                ring-1 ring-gray-200

                dark:bg-zinc-900
                dark:ring-zinc-700
            "
        >

            {{-- Header --}}
            <div
                class="
                    flex flex-col gap-3
                    border-b border-gray-200
                    px-4 py-4

                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    sm:px-6
                    sm:py-5

                    dark:border-zinc-700
                "
            >

                <div>

                    <h2
                        class="
                            text-lg font-semibold
                            text-gray-900
                            dark:text-white
                        "
                    >
                        Recent Rental Requests
                    </h2>

                    <p
                        class="
                            mt-1 text-sm
                            text-gray-500
                            dark:text-zinc-400
                        "
                    >
                        Latest customer rental activity
                    </p>

                </div>


                <a
                    href="{{ route('rentals.index') }}"
                    wire:navigate
                    class="
                        self-start
                        text-sm font-medium
                        text-gray-600
                        transition-colors

                        hover:text-gray-900

                        sm:self-auto

                        dark:text-zinc-400
                        dark:hover:text-white
                    "
                >
                    View all
                </a>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table
                    class="
                        min-w-[720px]
                        w-full
                        divide-y divide-gray-200

                        dark:divide-zinc-700
                    "
                >

                    <thead
                        class="
                            bg-gray-50
                            dark:bg-zinc-800
                        "
                    >

                        <tr>

                            <th
                                class="
                                    px-4 py-3
                                    text-left
                                    text-xs font-semibold
                                    uppercase tracking-wide
                                    text-gray-500

                                    sm:px-6

                                    dark:text-zinc-400
                                "
                            >
                                Customer
                            </th>


                            <th
                                class="
                                    px-4 py-3
                                    text-left
                                    text-xs font-semibold
                                    uppercase tracking-wide
                                    text-gray-500

                                    sm:px-6

                                    dark:text-zinc-400
                                "
                            >
                                Equipment
                            </th>


                            <th
                                class="
                                    px-4 py-3
                                    text-left
                                    text-xs font-semibold
                                    uppercase tracking-wide
                                    text-gray-500

                                    sm:px-6

                                    dark:text-zinc-400
                                "
                            >
                                Period
                            </th>


                            <th
                                class="
                                    px-4 py-3
                                    text-left
                                    text-xs font-semibold
                                    uppercase tracking-wide
                                    text-gray-500

                                    sm:px-6

                                    dark:text-zinc-400
                                "
                            >
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody
                        class="
                            divide-y divide-gray-100
                            dark:divide-zinc-800
                        "
                    >

                        @forelse ($recentRentals as $rental)

                            <tr
                                class="
                                    transition-colors
                                    hover:bg-gray-50
                                    dark:hover:bg-zinc-800/60
                                "
                            >

                                {{-- Customer --}}
                                <td
                                    class="
                                        px-4 py-4
                                        sm:px-6
                                    "
                                >

                                    <p
                                        class="
                                            text-sm font-medium
                                            text-gray-900
                                            dark:text-white
                                        "
                                    >
                                        {{ $rental->customer->name }}
                                    </p>

                                    <p
                                        class="
                                            mt-1 max-w-[220px]
                                            truncate
                                            text-xs text-gray-500

                                            dark:text-zinc-500
                                        "
                                    >
                                        {{ $rental->customer->email }}
                                    </p>

                                </td>


                                {{-- Equipment --}}
                                <td
                                    class="
                                        px-4 py-4
                                        sm:px-6
                                    "
                                >

                                    <p
                                        class="
                                            max-w-[200px]
                                            truncate
                                            text-sm font-medium
                                            text-gray-900

                                            dark:text-white
                                        "
                                    >
                                        {{ $rental->equipment->name }}
                                    </p>

                                    <p
                                        class="
                                            mt-1 text-xs
                                            text-gray-500
                                            dark:text-zinc-500
                                        "
                                    >
                                        Qty {{ $rental->quantity }}
                                    </p>

                                </td>


                                {{-- Period --}}
                                <td
                                    class="
                                        whitespace-nowrap
                                        px-4 py-4
                                        text-sm text-gray-600

                                        sm:px-6

                                        dark:text-zinc-400
                                    "
                                >

                                    <div>
                                        {{ $rental->rent_date->format('d M Y') }}
                                    </div>

                                    <div
                                        class="
                                            mt-1 text-xs
                                            text-gray-400
                                            dark:text-zinc-500
                                        "
                                    >
                                        to
                                        {{ $rental->return_date->format('d M Y') }}
                                    </div>

                                </td>


                                {{-- Status --}}
                                <td
                                    class="
                                        px-4 py-4
                                        sm:px-6
                                    "
                                >

                                    <x-rental-status
                                        :status="$rental->status"
                                    />

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="
                                        px-4 py-12
                                        text-center
                                        text-sm text-gray-500

                                        sm:px-6

                                        dark:text-zinc-400
                                    "
                                >
                                    No rental activity yet.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        {{-- ===================================================== --}}
        {{-- Top Equipment --}}
        {{-- ===================================================== --}}

        <section
            class="
                overflow-hidden
                rounded-xl
                bg-white
                shadow-sm
                ring-1 ring-gray-200

                dark:bg-zinc-900
                dark:ring-zinc-700
            "
        >

            {{-- Header --}}
            <div
                class="
                    border-b border-gray-200
                    px-4 py-4

                    sm:px-6
                    sm:py-5

                    dark:border-zinc-700
                "
            >

                <h2
                    class="
                        text-lg font-semibold
                        text-gray-900
                        dark:text-white
                    "
                >
                    Most Rented Equipment
                </h2>

                <p
                    class="
                        mt-1 text-sm
                        text-gray-500
                        dark:text-zinc-400
                    "
                >
                    Based on approved rental quantity
                </p>

            </div>


            <div
                class="
                    divide-y divide-gray-100
                    dark:divide-zinc-800
                "
            >

                @forelse ($topEquipment as $index => $equipment)

                    <div
                        class="
                            flex items-center gap-3
                            px-4 py-4

                            sm:gap-4
                            sm:px-6
                        "
                    >

                        {{-- Ranking --}}
                        <div
                            class="
                                flex h-9 w-9
                                shrink-0
                                items-center justify-center
                                rounded-full
                                bg-gray-100
                                text-sm font-bold
                                text-gray-700

                                dark:bg-zinc-800
                                dark:text-zinc-300
                            "
                        >
                            {{ $index + 1 }}
                        </div>


                        {{-- Equipment --}}
                        <div class="min-w-0 flex-1">

                            <p
                                class="
                                    truncate
                                    text-sm font-semibold
                                    text-gray-900
                                    dark:text-white
                                "
                            >
                                {{ $equipment->name }}
                            </p>

                            <p
                                class="
                                    mt-1 truncate
                                    text-xs text-gray-500
                                    dark:text-zinc-500
                                "
                            >
                                {{ $equipment->category }}
                            </p>

                        </div>


                        {{-- Quantity --}}
                        <div class="shrink-0 text-right">

                            <p
                                class="
                                    text-lg font-bold
                                    text-gray-900
                                    dark:text-white
                                "
                            >
                                {{ number_format(
                                    $equipment->rented_quantity_sum ?? 0
                                ) }}
                            </p>

                            <p
                                class="
                                    text-xs text-gray-400
                                    dark:text-zinc-500
                                "
                            >
                                units rented
                            </p>

                        </div>

                    </div>


                @empty

                    <div
                        class="
                            px-4 py-12
                            text-center
                            text-sm text-gray-500

                            sm:px-6

                            dark:text-zinc-400
                        "
                    >
                        No rental data yet.
                    </div>

                @endforelse

            </div>


            <div
                class="
                    border-t border-gray-200
                    px-4 py-4

                    sm:px-6

                    dark:border-zinc-700
                "
            >

                <a
                    href="{{ route('equipment.index') }}"
                    wire:navigate
                    class="
                        text-sm font-medium
                        text-gray-600
                        transition-colors

                        hover:text-gray-900

                        dark:text-zinc-400
                        dark:hover:text-white
                    "
                >
                    View equipment
                </a>

            </div>

        </section>

    </div>

</div>