<div
    class="
        mx-auto max-w-7xl
        space-y-6
        px-4 py-6

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
            Customers
        </h1>

        <p
            class="
                mt-2 text-sm
                text-gray-600

                sm:text-base

                dark:text-zinc-400
            "
        >
            View registered customers and their rental activity.
        </p>

    </div>


    {{-- ========================================================= --}}
    {{-- Filters --}}
    {{-- ========================================================= --}}

    <section
        class="
            rounded-xl
            bg-white p-4
            shadow-sm
            ring-1 ring-gray-200

            sm:p-5

            dark:bg-zinc-900
            dark:ring-zinc-700
        "
    >

        <div
            class="
                flex flex-col gap-4

                md:flex-row
                md:items-end
            "
        >

            <div class="flex-1">

                <label
                    for="customer-search"
                    class="
                        mb-1.5 block
                        text-sm font-medium
                        text-gray-700

                        dark:text-zinc-300
                    "
                >
                    Search
                </label>

                <input
                    id="customer-search"
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search name, email, or phone..."
                    class="
                        block w-full
                        rounded-lg
                        border border-gray-300
                        bg-white
                        px-3 py-2
                        text-sm text-gray-900
                        placeholder:text-gray-400

                        focus:border-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-900/10

                        dark:border-zinc-700
                        dark:bg-zinc-800
                        dark:text-white
                        dark:placeholder:text-zinc-500

                        dark:focus:border-zinc-500
                        dark:focus:ring-white/10
                    "
                >

            </div>


            <flux:button
                variant="ghost"
                wire:click="clearFilters"
                class="w-full md:w-auto"
            >
                Clear
            </flux:button>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- Customer Table --}}
    {{-- ========================================================= --}}

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

        <div class="overflow-x-auto">

            <table
                class="
                    min-w-[980px] w-full
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
                            Phone
                        </th>

                        <th
                            class="
                                px-4 py-3
                                text-center
                                text-xs font-semibold
                                uppercase tracking-wide
                                text-gray-500

                                sm:px-6

                                dark:text-zinc-400
                            "
                        >
                            Rentals
                        </th>

                        <th
                            class="
                                px-4 py-3
                                text-center
                                text-xs font-semibold
                                uppercase tracking-wide
                                text-gray-500

                                sm:px-6

                                dark:text-zinc-400
                            "
                        >
                            Active
                        </th>

                        <th
                            class="
                                px-4 py-3
                                text-center
                                text-xs font-semibold
                                uppercase tracking-wide
                                text-gray-500

                                sm:px-6

                                dark:text-zinc-400
                            "
                        >
                            Late
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
                            Joined
                        </th>

                        <th
                            class="
                                px-4 py-3
                                text-right
                                text-xs font-semibold
                                uppercase tracking-wide
                                text-gray-500

                                sm:px-6

                                dark:text-zinc-400
                            "
                        >
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody
                    class="
                        divide-y divide-gray-100
                        dark:divide-zinc-800
                    "
                >

                    @forelse ($customers as $customer)

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

                                <div class="min-w-0">

                                    <p
                                        class="
                                            max-w-[240px]
                                            truncate
                                            font-medium
                                            text-gray-900

                                            dark:text-white
                                        "
                                    >
                                        {{ $customer->name }}
                                    </p>

                                    <p
                                        class="
                                            mt-1 max-w-[240px]
                                            truncate
                                            text-sm text-gray-500

                                            dark:text-zinc-400
                                        "
                                    >
                                        {{ $customer->email }}
                                    </p>

                                </div>

                            </td>


                            {{-- Phone --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-sm text-gray-600

                                    sm:px-6

                                    dark:text-zinc-300
                                "
                            >
                                {{ $customer->phone_number }}
                            </td>


                            {{-- Total Rentals --}}
                            <td
                                class="
                                    px-4 py-4
                                    text-center

                                    sm:px-6
                                "
                            >

                                <span
                                    class="
                                        inline-flex min-w-8
                                        justify-center
                                        rounded-full
                                        bg-gray-100
                                        px-2.5 py-1
                                        text-xs font-semibold
                                        text-gray-700

                                        dark:bg-zinc-800
                                        dark:text-zinc-300
                                    "
                                >
                                    {{ $customer->rentals_count }}
                                </span>

                            </td>


                            {{-- Active --}}
                            <td
                                class="
                                    px-4 py-4
                                    text-center

                                    sm:px-6
                                "
                            >

                                @if ($customer->active_rentals_count > 0)

                                    <span
                                        class="
                                            inline-flex rounded-full
                                            bg-blue-100
                                            px-2.5 py-1
                                            text-xs font-semibold
                                            text-blue-700

                                            dark:bg-blue-950/50
                                            dark:text-blue-300
                                        "
                                    >
                                        {{ $customer->active_rentals_count }}
                                    </span>

                                @else

                                    <span
                                        class="
                                            text-sm text-gray-400
                                            dark:text-zinc-500
                                        "
                                    >
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Late --}}
                            <td
                                class="
                                    px-4 py-4
                                    text-center

                                    sm:px-6
                                "
                            >

                                @if ($customer->late_rentals_count > 0)

                                    <span
                                        class="
                                            inline-flex rounded-full
                                            bg-red-100
                                            px-2.5 py-1
                                            text-xs font-semibold
                                            text-red-700

                                            dark:bg-red-950/50
                                            dark:text-red-300
                                        "
                                    >
                                        {{ $customer->late_rentals_count }}
                                    </span>

                                @else

                                    <span
                                        class="
                                            text-sm text-gray-400
                                            dark:text-zinc-500
                                        "
                                    >
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Joined --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-sm text-gray-600

                                    sm:px-6

                                    dark:text-zinc-300
                                "
                            >
                                {{ $customer->created_at->format('d M Y') }}
                            </td>


                            {{-- Action --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-right

                                    sm:px-6
                                "
                            >

                                <flux:button
                                    size="sm"
                                    variant="ghost"
                                    wire:click="viewCustomer({{ $customer->id }})"
                                >
                                    View
                                </flux:button>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="
                                    px-4 py-14
                                    text-center

                                    sm:px-6
                                "
                            >

                                @if ($search)

                                    <p
                                        class="
                                            font-medium
                                            text-gray-900

                                            dark:text-white
                                        "
                                    >
                                        No customers found
                                    </p>

                                    <p
                                        class="
                                            mt-1 text-sm
                                            text-gray-500

                                            dark:text-zinc-400
                                        "
                                    >
                                        No customer matches
                                        "{{ $search }}".
                                    </p>

                                @else

                                    <p
                                        class="
                                            font-medium
                                            text-gray-900

                                            dark:text-white
                                        "
                                    >
                                        No customers yet
                                    </p>

                                    <p
                                        class="
                                            mt-1 text-sm
                                            text-gray-500

                                            dark:text-zinc-400
                                        "
                                    >
                                        Registered customers will appear here.
                                    </p>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($customers->hasPages())

            <div
                class="
                    border-t border-gray-200
                    px-4 py-4

                    sm:px-6

                    dark:border-zinc-700
                "
            >
                {{ $customers->links() }}
            </div>

        @endif

    </section>


    {{-- ========================================================= --}}
    {{-- Customer Details Modal --}}
    {{-- ========================================================= --}}

    @if ($showCustomerModal && $selectedCustomer)

        <div
            class="
                fixed inset-0 z-50
                flex items-end justify-center
                bg-black/60

                sm:items-center
                sm:px-4
                sm:py-8
            "
        >

            <div
                class="
                    max-h-[94vh] w-full
                    overflow-y-auto
                    rounded-t-2xl
                    bg-white
                    shadow-xl

                    sm:max-w-5xl
                    sm:rounded-xl

                    dark:bg-zinc-900
                    dark:ring-1
                    dark:ring-zinc-700
                "
            >

                {{-- ================================================= --}}
                {{-- Modal Header --}}
                {{-- ================================================= --}}

                <div
                    class="
                        sticky top-0 z-10
                        flex items-start justify-between gap-4
                        border-b border-gray-200
                        bg-white
                        px-4 py-4

                        sm:px-6
                        sm:py-5

                        dark:border-zinc-700
                        dark:bg-zinc-900
                    "
                >

                    <div class="min-w-0">

                        <h2
                            class="
                                truncate
                                text-xl font-bold
                                text-gray-900

                                dark:text-white
                            "
                        >
                            {{ $selectedCustomer->name }}
                        </h2>

                        <p
                            class="
                                mt-1 text-sm
                                text-gray-500

                                dark:text-zinc-400
                            "
                        >
                            Customer details and rental history
                        </p>

                    </div>


                    <button
                        type="button"
                        wire:click="closeCustomerModal"
                        class="
                            shrink-0
                            text-2xl leading-none
                            text-gray-400
                            transition-colors

                            hover:text-gray-700

                            dark:text-zinc-500
                            dark:hover:text-white
                        "
                        aria-label="Close customer details"
                    >
                        &times;
                    </button>

                </div>


                <div
                    class="
                        space-y-8
                        p-4

                        sm:p-6
                    "
                >

                    {{-- ================================================= --}}
                    {{-- Profile --}}
                    {{-- ================================================= --}}

                    <section>

                        <h3
                            class="
                                mb-4
                                text-sm font-semibold
                                uppercase tracking-wide
                                text-gray-500

                                dark:text-zinc-400
                            "
                        >
                            Customer Information
                        </h3>


                        <div
                            class="
                                grid gap-5
                                rounded-xl
                                bg-gray-50
                                p-4

                                sm:grid-cols-2
                                sm:p-5

                                dark:bg-zinc-800
                            "
                        >

                            <div>

                                <p
                                    class="
                                        text-xs font-medium
                                        uppercase
                                        text-gray-400

                                        dark:text-zinc-500
                                    "
                                >
                                    Name
                                </p>

                                <p
                                    class="
                                        mt-1
                                        break-words
                                        text-sm font-medium
                                        text-gray-900

                                        dark:text-white
                                    "
                                >
                                    {{ $selectedCustomer->name }}
                                </p>

                            </div>


                            <div>

                                <p
                                    class="
                                        text-xs font-medium
                                        uppercase
                                        text-gray-400

                                        dark:text-zinc-500
                                    "
                                >
                                    Email
                                </p>

                                <p
                                    class="
                                        mt-1
                                        break-all
                                        text-sm text-gray-900

                                        dark:text-zinc-200
                                    "
                                >
                                    {{ $selectedCustomer->email }}
                                </p>

                            </div>


                            <div>

                                <p
                                    class="
                                        text-xs font-medium
                                        uppercase
                                        text-gray-400

                                        dark:text-zinc-500
                                    "
                                >
                                    Phone
                                </p>

                                <p
                                    class="
                                        mt-1 text-sm
                                        text-gray-900

                                        dark:text-zinc-200
                                    "
                                >
                                    {{ $selectedCustomer->phone_number }}
                                </p>

                            </div>


                            <div>

                                <p
                                    class="
                                        text-xs font-medium
                                        uppercase
                                        text-gray-400

                                        dark:text-zinc-500
                                    "
                                >
                                    Joined
                                </p>

                                <p
                                    class="
                                        mt-1 text-sm
                                        text-gray-900

                                        dark:text-zinc-200
                                    "
                                >
                                    {{ $selectedCustomer->created_at->format('d M Y') }}
                                </p>

                            </div>


                            <div class="sm:col-span-2">

                                <p
                                    class="
                                        text-xs font-medium
                                        uppercase
                                        text-gray-400

                                        dark:text-zinc-500
                                    "
                                >
                                    Address
                                </p>

                                <p
                                    class="
                                        mt-1
                                        break-words
                                        text-sm leading-6
                                        text-gray-900

                                        dark:text-zinc-200
                                    "
                                >
                                    {{ $selectedCustomer->address }}
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- ================================================= --}}
                    {{-- Statistics --}}
                    {{-- ================================================= --}}

                    <section>

                        <h3
                            class="
                                mb-4
                                text-sm font-semibold
                                uppercase tracking-wide
                                text-gray-500

                                dark:text-zinc-400
                            "
                        >
                            Rental Summary
                        </h3>


                        <div
                            class="
                                grid grid-cols-2 gap-3

                                sm:gap-4

                                lg:grid-cols-5
                            "
                        >

                            {{-- Total --}}
                            <div
                                class="
                                    rounded-lg
                                    border border-gray-200
                                    bg-white
                                    p-4

                                    dark:border-zinc-700
                                    dark:bg-zinc-800
                                "
                            >

                                <p
                                    class="
                                        text-sm text-gray-500
                                        dark:text-zinc-400
                                    "
                                >
                                    Total
                                </p>

                                <p
                                    class="
                                        mt-1 text-2xl font-bold
                                        text-gray-900

                                        dark:text-white
                                    "
                                >
                                    {{ $selectedCustomer->rentals_count }}
                                </p>

                            </div>


                            {{-- Pending --}}
                            <div
                                class="
                                    rounded-lg
                                    border border-yellow-200
                                    bg-yellow-50
                                    p-4

                                    dark:border-yellow-900/50
                                    dark:bg-yellow-950/20
                                "
                            >

                                <p
                                    class="
                                        text-sm text-yellow-700
                                        dark:text-yellow-400
                                    "
                                >
                                    Pending
                                </p>

                                <p
                                    class="
                                        mt-1 text-2xl font-bold
                                        text-yellow-800

                                        dark:text-yellow-300
                                    "
                                >
                                    {{ $selectedCustomer->pending_rentals_count }}
                                </p>

                            </div>


                            {{-- Active --}}
                            <div
                                class="
                                    rounded-lg
                                    border border-blue-200
                                    bg-blue-50
                                    p-4

                                    dark:border-blue-900/50
                                    dark:bg-blue-950/20
                                "
                            >

                                <p
                                    class="
                                        text-sm text-blue-700
                                        dark:text-blue-400
                                    "
                                >
                                    Active
                                </p>

                                <p
                                    class="
                                        mt-1 text-2xl font-bold
                                        text-blue-800

                                        dark:text-blue-300
                                    "
                                >
                                    {{ $selectedCustomer->active_rentals_count }}
                                </p>

                            </div>


                            {{-- Late --}}
                            <div
                                class="
                                    rounded-lg
                                    border border-red-200
                                    bg-red-50
                                    p-4

                                    dark:border-red-900/50
                                    dark:bg-red-950/20
                                "
                            >

                                <p
                                    class="
                                        text-sm text-red-700
                                        dark:text-red-400
                                    "
                                >
                                    Late
                                </p>

                                <p
                                    class="
                                        mt-1 text-2xl font-bold
                                        text-red-800

                                        dark:text-red-300
                                    "
                                >
                                    {{ $selectedCustomer->late_rentals_count }}
                                </p>

                            </div>


                            {{-- Returned --}}
                            <div
                                class="
                                    col-span-2
                                    rounded-lg
                                    border border-green-200
                                    bg-green-50
                                    p-4

                                    lg:col-span-1

                                    dark:border-green-900/50
                                    dark:bg-green-950/20
                                "
                            >

                                <p
                                    class="
                                        text-sm text-green-700
                                        dark:text-green-400
                                    "
                                >
                                    Returned
                                </p>

                                <p
                                    class="
                                        mt-1 text-2xl font-bold
                                        text-green-800

                                        dark:text-green-300
                                    "
                                >
                                    {{ $selectedCustomer->returned_rentals_count }}
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- ================================================= --}}
                    {{-- Rental History --}}
                    {{-- ================================================= --}}

                    <section>

                        <h3
                            class="
                                mb-4
                                text-sm font-semibold
                                uppercase tracking-wide
                                text-gray-500

                                dark:text-zinc-400
                            "
                        >
                            Rental History
                        </h3>


                        <div
                            class="
                                overflow-hidden
                                rounded-xl
                                border border-gray-200

                                dark:border-zinc-700
                            "
                        >

                            <div class="overflow-x-auto">

                                <table
                                    class="
                                        min-w-[760px] w-full
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
                                                    uppercase
                                                    text-gray-500

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
                                                    uppercase
                                                    text-gray-500

                                                    dark:text-zinc-400
                                                "
                                            >
                                                Period
                                            </th>

                                            <th
                                                class="
                                                    px-4 py-3
                                                    text-center
                                                    text-xs font-semibold
                                                    uppercase
                                                    text-gray-500

                                                    dark:text-zinc-400
                                                "
                                            >
                                                Qty
                                            </th>

                                            <th
                                                class="
                                                    px-4 py-3
                                                    text-left
                                                    text-xs font-semibold
                                                    uppercase
                                                    text-gray-500

                                                    dark:text-zinc-400
                                                "
                                            >
                                                Total
                                            </th>

                                            <th
                                                class="
                                                    px-4 py-3
                                                    text-left
                                                    text-xs font-semibold
                                                    uppercase
                                                    text-gray-500

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
                                            bg-white

                                            dark:divide-zinc-800
                                            dark:bg-zinc-900
                                        "
                                    >

                                        @forelse (
                                            $selectedCustomer->rentals
                                            as $rental
                                        )

                                            <tr
                                                class="
                                                    transition-colors
                                                    hover:bg-gray-50

                                                    dark:hover:bg-zinc-800/60
                                                "
                                            >

                                                <td
                                                    class="
                                                        px-4 py-4
                                                        text-sm
                                                    "
                                                >

                                                    <p
                                                        class="
                                                            max-w-[220px]
                                                            truncate
                                                            font-medium
                                                            text-gray-900

                                                            dark:text-white
                                                        "
                                                    >
                                                        {{ $rental->equipment->name }}
                                                    </p>

                                                    <p
                                                        class="
                                                            mt-1
                                                            max-w-[220px]
                                                            truncate
                                                            text-xs text-gray-500

                                                            dark:text-zinc-400
                                                        "
                                                    >
                                                        {{ $rental->equipment->category }}
                                                    </p>

                                                </td>


                                                <td
                                                    class="
                                                        whitespace-nowrap
                                                        px-4 py-4
                                                        text-sm text-gray-600

                                                        dark:text-zinc-300
                                                    "
                                                >
                                                    {{ $rental->rent_date->format('d M Y') }}

                                                    <span
                                                        class="
                                                            mx-1
                                                            text-gray-400

                                                            dark:text-zinc-500
                                                        "
                                                    >
                                                        →
                                                    </span>

                                                    {{ $rental->return_date->format('d M Y') }}
                                                </td>


                                                <td
                                                    class="
                                                        px-4 py-4
                                                        text-center
                                                        text-sm text-gray-600

                                                        dark:text-zinc-300
                                                    "
                                                >
                                                    {{ $rental->quantity }}
                                                </td>


                                                <td
                                                    class="
                                                        whitespace-nowrap
                                                        px-4 py-4
                                                        text-sm font-medium
                                                        text-gray-900

                                                        dark:text-white
                                                    "
                                                >
                                                    Rp {{ number_format(
                                                        $rental->total_price,
                                                        0,
                                                        ',',
                                                        '.'
                                                    ) }}
                                                </td>


                                                <td class="px-4 py-4">

                                                    <x-rental-status
                                                        :status="$rental->status"
                                                    />

                                                </td>

                                            </tr>


                                        @empty

                                            <tr>

                                                <td
                                                    colspan="5"
                                                    class="
                                                        px-4 py-10
                                                        text-center
                                                        text-sm text-gray-500

                                                        dark:text-zinc-400
                                                    "
                                                >
                                                    This customer has no rental history.
                                                </td>

                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </section>

                </div>


                {{-- ================================================= --}}
                {{-- Footer --}}
                {{-- ================================================= --}}

                <div
                    class="
                        sticky bottom-0
                        flex justify-end
                        border-t border-gray-200
                        bg-white
                        px-4 py-4

                        sm:px-6

                        dark:border-zinc-700
                        dark:bg-zinc-900
                    "
                >

                    <flux:button
                        variant="ghost"
                        wire:click="closeCustomerModal"
                        class="w-full sm:w-auto"
                    >
                        Close
                    </flux:button>

                </div>

            </div>

        </div>

    @endif

</div>