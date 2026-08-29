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
    {{-- Page Header --}}
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
            Rental Management
        </h1>

        <p
            class="
                mt-2 text-sm
                text-gray-600

                sm:text-base

                dark:text-zinc-400
            "
        >
            Review and manage customer rental requests.
        </p>

    </div>


    {{-- ========================================================= --}}
    {{-- Notifications --}}
    {{-- ========================================================= --}}

    @if (session('success'))

        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition
            class="
                flex items-start justify-between gap-4
                rounded-lg
                border border-green-200
                bg-green-50
                px-4 py-3
                text-sm text-green-700

                dark:border-green-900/60
                dark:bg-green-950/30
                dark:text-green-300
            "
        >

            <span>
                {{ session('success') }}
            </span>

            <button
                type="button"
                @click="show = false"
                class="
                    shrink-0
                    font-medium
                    transition-colors

                    hover:text-green-900

                    dark:hover:text-green-100
                "
                aria-label="Dismiss notification"
            >
                &times;
            </button>

        </div>

    @endif


    @error('rentalAction')

        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            class="
                flex items-start justify-between gap-4
                rounded-lg
                border border-red-200
                bg-red-50
                px-4 py-3
                text-sm text-red-700

                dark:border-red-900/60
                dark:bg-red-950/30
                dark:text-red-300
            "
        >

            <span>
                {{ $message }}
            </span>

            <button
                type="button"
                @click="show = false"
                class="
                    shrink-0
                    font-medium
                    transition-colors

                    hover:text-red-900

                    dark:hover:text-red-100
                "
                aria-label="Dismiss notification"
            >
                &times;
            </button>

        </div>

    @enderror


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
                grid gap-4

                sm:grid-cols-2

                lg:grid-cols-[minmax(260px,1fr)_220px_auto]
            "
        >

            {{-- Search --}}
            <div class="sm:col-span-2 lg:col-span-1">

                <label
                    for="search"
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
                    id="search"
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search customer or equipment..."
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


            {{-- Status Filter --}}
            <div>

                <label
                    for="status"
                    class="
                        mb-1.5 block
                        text-sm font-medium
                        text-gray-700

                        dark:text-zinc-300
                    "
                >
                    Status
                </label>

                <select
                    id="status"
                    wire:model.live="statusFilter"
                    class="
                        block w-full
                        rounded-lg
                        border border-gray-300
                        bg-white
                        px-3 py-2
                        text-sm text-gray-900

                        focus:border-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-900/10

                        dark:border-zinc-700
                        dark:bg-zinc-800
                        dark:text-white

                        dark:focus:border-zinc-500
                        dark:focus:ring-white/10
                    "
                >

                    <option value="">
                        All Statuses
                    </option>

                    <option value="Pending">
                        Pending
                    </option>

                    <option value="Rented">
                        Rented
                    </option>

                    <option value="Late">
                        Late
                    </option>

                    <option value="Returned">
                        Returned
                    </option>

                    <option value="Cancelled">
                        Cancelled
                    </option>

                </select>

            </div>


            {{-- Reset --}}
            <div
                class="
                    flex items-end

                    sm:col-span-2

                    lg:col-span-1
                "
            >

                <flux:button
                    variant="ghost"
                    wire:click="clearFilters"
                    class="w-full lg:w-auto"
                >
                    Clear Filters
                </flux:button>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- Rentals Table --}}
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
                    min-w-[1100px] w-full
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
                            Quantity
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
                            Rental Period
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
                            Total
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
                            Actions
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

                    @forelse ($rentals as $rental)

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

                                <div
                                    class="
                                        max-w-[220px]
                                        truncate
                                        font-medium
                                        text-gray-900

                                        dark:text-white
                                    "
                                >
                                    {{ $rental->customer->name }}
                                </div>

                                <div
                                    class="
                                        mt-1 max-w-[220px]
                                        truncate
                                        text-sm text-gray-500

                                        dark:text-zinc-400
                                    "
                                >
                                    {{ $rental->customer->email }}
                                </div>

                            </td>


                            {{-- Equipment --}}
                            <td
                                class="
                                    px-4 py-4

                                    sm:px-6
                                "
                            >

                                <div
                                    class="
                                        max-w-[220px]
                                        truncate
                                        font-medium
                                        text-gray-900

                                        dark:text-white
                                    "
                                >
                                    {{ $rental->equipment->name }}
                                </div>

                                <div
                                    class="
                                        mt-1 max-w-[220px]
                                        truncate
                                        text-sm text-gray-500

                                        dark:text-zinc-400
                                    "
                                >
                                    {{ $rental->equipment->category }}
                                </div>

                            </td>


                            {{-- Quantity --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-sm text-gray-700

                                    sm:px-6

                                    dark:text-zinc-300
                                "
                            >
                                {{ $rental->quantity }}
                            </td>


                            {{-- Rental Period --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-sm text-gray-700

                                    sm:px-6

                                    dark:text-zinc-300
                                "
                            >

                                <div>
                                    {{ $rental->rent_date->format('d M Y') }}
                                </div>

                                <div
                                    class="
                                        my-0.5 text-xs
                                        text-gray-400

                                        dark:text-zinc-500
                                    "
                                >
                                    to
                                </div>

                                <div>
                                    {{ $rental->return_date->format('d M Y') }}
                                </div>

                            </td>


                            {{-- Total Price --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    font-medium
                                    text-gray-900

                                    sm:px-6

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


                            {{-- Status --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4

                                    sm:px-6
                                "
                            >

                                <x-rental-status
                                    :status="$rental->status"
                                />

                            </td>


                            {{-- Actions --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-right

                                    sm:px-6
                                "
                            >

                                @if ($rental->status === 'Pending')

                                    <div
                                        class="
                                            flex justify-end gap-2
                                        "
                                    >

                                        <flux:button
                                            size="sm"
                                            variant="primary"
                                            wire:click="confirmApprove({{ $rental->id }})"
                                        >
                                            Approve
                                        </flux:button>

                                        <flux:button
                                            size="sm"
                                            variant="danger"
                                            wire:click="confirmReject({{ $rental->id }})"
                                        >
                                            Reject
                                        </flux:button>

                                    </div>

                                @elseif (in_array(
                                    $rental->status,
                                    ['Rented', 'Late']
                                ))

                                    <flux:button
                                        size="sm"
                                        variant="primary"
                                        wire:click="confirmReturn({{ $rental->id }})"
                                    >
                                        Mark Returned
                                    </flux:button>

                                @else

                                    <span
                                        class="
                                            text-sm text-gray-400
                                            dark:text-zinc-500
                                        "
                                    >
                                        No actions
                                    </span>

                                @endif

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

                                <p
                                    class="
                                        text-sm text-gray-500
                                        dark:text-zinc-400
                                    "
                                >
                                    No rental requests found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($rentals->hasPages())

            <div
                class="
                    border-t border-gray-200
                    px-4 py-4

                    sm:px-6

                    dark:border-zinc-700
                "
            >
                {{ $rentals->links() }}
            </div>

        @endif

    </section>


    {{-- ========================================================= --}}
    {{-- Confirmation Modal --}}
    {{-- ========================================================= --}}

    @if ($showActionModal && $selectedRental)

        <div
            class="
                fixed inset-0 z-50
                flex items-end justify-center
                bg-black/60

                sm:items-center
                sm:px-4
            "
        >

            <div
                class="
                    w-full
                    rounded-t-2xl
                    bg-white
                    p-5
                    shadow-xl

                    sm:max-w-md
                    sm:rounded-xl
                    sm:p-6

                    dark:bg-zinc-900
                    dark:ring-1
                    dark:ring-zinc-700
                "
            >

                {{-- ================================================= --}}
                {{-- Approve --}}
                {{-- ================================================= --}}

                @if ($actionType === 'approve')

                    <h2
                        class="
                            text-xl font-bold
                            text-gray-900

                            dark:text-white
                        "
                    >
                        Approve Rental
                    </h2>

                    <p
                        class="
                            mt-2 text-sm
                            leading-6
                            text-gray-600

                            dark:text-zinc-300
                        "
                    >
                        Are you sure you want to approve
                        <span
                            class="
                                font-semibold
                                text-gray-900

                                dark:text-white
                            "
                        >
                            {{ $selectedRental->customer->name }}
                        </span>'s rental request for
                        <span
                            class="
                                font-semibold
                                text-gray-900

                                dark:text-white
                            "
                        >
                            {{ $selectedRental->equipment->name }}
                        </span>?
                    </p>


                    <div
                        class="
                            mt-4
                            space-y-3
                            rounded-lg
                            bg-gray-50
                            p-4

                            dark:bg-zinc-800
                        "
                    >

                        <div
                            class="
                                flex items-center justify-between gap-4
                                text-sm
                            "
                        >

                            <span
                                class="
                                    text-gray-500
                                    dark:text-zinc-400
                                "
                            >
                                Requested quantity
                            </span>

                            <span
                                class="
                                    font-medium
                                    text-gray-900

                                    dark:text-white
                                "
                            >
                                {{ $selectedRental->quantity }}
                            </span>

                        </div>


                        <div
                            class="
                                flex items-center justify-between gap-4
                                text-sm
                            "
                        >

                            <span
                                class="
                                    text-gray-500
                                    dark:text-zinc-400
                                "
                            >
                                Total equipment stock
                            </span>

                            <span
                                class="
                                    font-medium
                                    text-gray-900

                                    dark:text-white
                                "
                            >
                                {{ $selectedRental->equipment->stock }}
                            </span>

                        </div>

                    </div>


                {{-- ================================================= --}}
                {{-- Reject --}}
                {{-- ================================================= --}}

                @elseif ($actionType === 'reject')

                    <h2
                        class="
                            text-xl font-bold
                            text-gray-900

                            dark:text-white
                        "
                    >
                        Reject Rental
                    </h2>

                    <p
                        class="
                            mt-2 text-sm
                            leading-6
                            text-gray-600

                            dark:text-zinc-300
                        "
                    >
                        Are you sure you want to reject this rental request?
                    </p>

                    <p
                        class="
                            mt-2 text-sm
                            text-gray-500

                            dark:text-zinc-400
                        "
                    >
                        The rental status will be changed to
                        <span
                            class="
                                font-semibold
                                text-gray-700

                                dark:text-zinc-200
                            "
                        >
                            Cancelled
                        </span>.
                    </p>


                {{-- ================================================= --}}
                {{-- Return --}}
                {{-- ================================================= --}}

                @elseif ($actionType === 'return')

                    <h2
                        class="
                            text-xl font-bold
                            text-gray-900

                            dark:text-white
                        "
                    >
                        Mark Rental as Returned
                    </h2>

                    <p
                        class="
                            mt-2 text-sm
                            leading-6
                            text-gray-600

                            dark:text-zinc-300
                        "
                    >
                        Confirm that
                        <span
                            class="
                                font-semibold
                                text-gray-900

                                dark:text-white
                            "
                        >
                            {{ $selectedRental->equipment->name }}
                        </span>
                        has been returned.
                    </p>

                    <p
                        class="
                            mt-2 text-sm
                            text-gray-500

                            dark:text-zinc-400
                        "
                    >
                        {{ $selectedRental->quantity }}
                        unit(s) will become available for future rental periods.
                    </p>

                @endif


                {{-- ================================================= --}}
                {{-- Actions --}}
                {{-- ================================================= --}}

                <div
                    class="
                        mt-6
                        flex flex-col-reverse gap-2
                        border-t border-gray-100
                        pt-5

                        sm:flex-row
                        sm:justify-end
                        sm:gap-3

                        dark:border-zinc-800
                    "
                >

                    <flux:button
                        variant="ghost"
                        wire:click="cancelAction"
                        class="w-full sm:w-auto"
                    >
                        Cancel
                    </flux:button>


                    @if ($actionType === 'approve')

                        <flux:button
                            variant="primary"
                            wire:click="approveRental"
                            wire:loading.attr="disabled"
                            wire:target="approveRental"
                            class="w-full sm:w-auto"
                        >

                            <span
                                wire:loading.remove
                                wire:target="approveRental"
                            >
                                Approve Rental
                            </span>

                            <span
                                wire:loading
                                wire:target="approveRental"
                            >
                                Approving...
                            </span>

                        </flux:button>


                    @elseif ($actionType === 'reject')

                        <flux:button
                            variant="danger"
                            wire:click="rejectRental"
                            wire:loading.attr="disabled"
                            wire:target="rejectRental"
                            class="w-full sm:w-auto"
                        >

                            <span
                                wire:loading.remove
                                wire:target="rejectRental"
                            >
                                Reject Rental
                            </span>

                            <span
                                wire:loading
                                wire:target="rejectRental"
                            >
                                Rejecting...
                            </span>

                        </flux:button>


                    @elseif ($actionType === 'return')

                        <flux:button
                            variant="primary"
                            wire:click="returnRental"
                            wire:loading.attr="disabled"
                            wire:target="returnRental"
                            class="w-full sm:w-auto"
                        >

                            <span
                                wire:loading.remove
                                wire:target="returnRental"
                            >
                                Confirm Return
                            </span>

                            <span
                                wire:loading
                                wire:target="returnRental"
                            >
                                Processing...
                            </span>

                        </flux:button>

                    @endif

                </div>

            </div>

        </div>

    @endif

</div>