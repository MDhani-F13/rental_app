<div
    class="
        mx-auto max-w-7xl
        px-4 py-6
        sm:px-6 sm:py-8
        lg:px-8 lg:py-10
    "
>

    {{-- Page Header --}}
    <div class="mb-6 sm:mb-8">

        <h2
            class="
                text-2xl font-bold
                text-gray-900
                sm:text-3xl
                dark:text-white
            "
        >
            My Rentals
        </h2>

        <p
            class="
                mt-2 text-sm
                text-gray-600
                sm:text-base
                dark:text-gray-400
            "
        >
            View and manage your rental requests.
        </p>

    </div>


    {{-- Success Notification --}}
    @if (session('success'))

        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition
            class="
                mb-6 flex items-center justify-between
                rounded-lg
                border border-green-200
                bg-green-50
                px-4 py-3
                text-sm text-green-700

                dark:border-green-900
                dark:bg-green-950/40
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
                    ml-4 font-medium
                    hover:text-green-900
                    dark:hover:text-green-100
                "
            >
                &times;
            </button>

        </div>

    @endif


    {{-- Error Notification --}}
    @if (session('error'))

        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 5000)"
            x-show="show"
            x-transition
            class="
                mb-6 flex items-center justify-between
                rounded-lg
                border border-red-200
                bg-red-50
                px-4 py-3
                text-sm text-red-700

                dark:border-red-900
                dark:bg-red-950/40
                dark:text-red-300
            "
        >

            <span>
                {{ session('error') }}
            </span>

            <button
                type="button"
                @click="show = false"
                class="
                    ml-4 font-medium
                    hover:text-red-900
                    dark:hover:text-red-100
                "
            >
                &times;
            </button>

        </div>

    @endif


    {{-- Filters --}}
    <div
        class="
            mb-6 rounded-xl
            bg-white p-4
            shadow-sm
            ring-1 ring-gray-200

            sm:mb-8
            sm:p-5

            dark:bg-gray-900
            dark:ring-gray-800
        "
    >

        <div
            class="
                grid gap-4
                md:grid-cols-[1fr_220px_auto]
            "
        >

            {{-- Search --}}
            <div>

                <label
                    for="rental-search"
                    class="
                        mb-1 block
                        text-sm font-medium
                        text-gray-700
                        dark:text-gray-300
                    "
                >
                    Search
                </label>

                <input
                    id="rental-search"
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search equipment..."
                    class="
                        block w-full rounded-lg
                        border border-gray-300
                        bg-white
                        px-3 py-2
                        text-sm text-gray-900

                        focus:border-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-900/10

                        dark:border-gray-700
                        dark:bg-gray-800
                        dark:text-gray-100
                        dark:focus:border-gray-500
                        dark:focus:ring-gray-500/20
                    "
                >

            </div>


            {{-- Status Filter --}}
            <div>

                <label
                    for="rental-status"
                    class="
                        mb-1 block
                        text-sm font-medium
                        text-gray-700
                        dark:text-gray-300
                    "
                >
                    Status
                </label>

                <select
                    id="rental-status"
                    wire:model.live="statusFilter"
                    class="
                        block w-full rounded-lg
                        border border-gray-300
                        bg-white
                        px-3 py-2
                        text-sm text-gray-900

                        focus:border-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-900/10

                        dark:border-gray-700
                        dark:bg-gray-800
                        dark:text-gray-100
                        dark:focus:border-gray-500
                        dark:focus:ring-gray-500/20
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


            {{-- Clear Filters --}}
            <div class="flex items-end">

                <flux:button
                    variant="ghost"
                    wire:click="clearFilters"
                    class="w-full md:w-auto"
                >
                    Clear Filters
                </flux:button>

            </div>

        </div>

    </div>


    {{-- Rental List --}}
    <div class="space-y-5">

        @forelse ($rentals as $rental)

            <div
                class="
                    rounded-xl
                    bg-white p-4
                    shadow-sm
                    ring-1 ring-gray-200

                    sm:p-6

                    dark:bg-gray-900
                    dark:ring-gray-800
                "
            >

                {{-- Main Rental Information --}}
                <div
                    class="
                        flex flex-col gap-6

                        lg:flex-row
                        lg:items-center
                        lg:justify-between
                    "
                >

                    {{-- Equipment --}}
                    <div class="flex min-w-0 items-center gap-4">

                        @if ($rental->equipment->picture)

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $rental->equipment->picture
                                ) }}"
                                alt="{{ $rental->equipment->name }}"
                                class="
                                    h-20 w-20 shrink-0
                                    rounded-lg object-cover
                                "
                            >

                        @else

                            <div
                                class="
                                    flex h-20 w-20 shrink-0
                                    items-center justify-center
                                    rounded-lg
                                    bg-gray-100
                                    dark:bg-gray-800
                                "
                            >

                                <span
                                    class="
                                        text-xs text-gray-400
                                        dark:text-gray-500
                                    "
                                >
                                    No image
                                </span>

                            </div>

                        @endif


                        <div class="min-w-0">

                            <h3
                                class="
                                    truncate text-lg font-semibold
                                    text-gray-900
                                    dark:text-white
                                "
                            >
                                {{ $rental->equipment->name }}
                            </h3>

                            <p
                                class="
                                    mt-1 text-sm
                                    text-gray-500
                                    dark:text-gray-400
                                "
                            >
                                {{ $rental->equipment->category }}
                            </p>

                            <p
                                class="
                                    mt-2 text-sm
                                    text-gray-600
                                    dark:text-gray-400
                                "
                            >
                                Quantity:

                                <span
                                    class="
                                        font-medium
                                        text-gray-900
                                        dark:text-gray-100
                                    "
                                >
                                    {{ $rental->quantity }}
                                </span>
                            </p>

                        </div>

                    </div>


                    {{-- Rental Details --}}
                    <div
                        class="
                            grid grid-cols-2 gap-5

                            sm:grid-cols-3

                            lg:min-w-[520px]
                        "
                    >

                        {{-- Period --}}
                        <div class="col-span-2 sm:col-span-1">

                            <p
                                class="
                                    text-xs font-medium
                                    uppercase tracking-wide
                                    text-gray-400
                                    dark:text-gray-500
                                "
                            >
                                Rental Period
                            </p>

                            <p
                                class="
                                    mt-1 text-sm font-medium
                                    text-gray-900
                                    dark:text-gray-100
                                "
                            >
                                {{ $rental->rent_date->format('d M Y') }}
                            </p>

                            <p
                                class="
                                    text-xs text-gray-500
                                    dark:text-gray-400
                                "
                            >
                                to
                                {{ $rental->return_date->format('d M Y') }}
                            </p>

                        </div>


                        {{-- Total --}}
                        <div>

                            <p
                                class="
                                    text-xs font-medium
                                    uppercase tracking-wide
                                    text-gray-400
                                    dark:text-gray-500
                                "
                            >
                                Total
                            </p>

                            <p
                                class="
                                    mt-1 text-sm font-semibold
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
                            </p>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p
                                class="
                                    text-xs font-medium
                                    uppercase tracking-wide
                                    text-gray-400
                                    dark:text-gray-500
                                "
                            >
                                Status
                            </p>

                            <div class="mt-1">

                                <x-rental-status
                                    :status="$rental->status"
                                />

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Status Explanation --}}
                <div
                    class="
                        mt-5 border-t
                        border-gray-100 pt-4
                        dark:border-gray-800
                    "
                >

                    @if ($rental->status === 'Pending')

                        <p
                            class="
                                text-sm text-gray-500
                                dark:text-gray-400
                            "
                        >
                            Your rental request is waiting for approval.
                        </p>


                    @elseif ($rental->status === 'Rented')

                        <p
                            class="
                                text-sm text-gray-500
                                dark:text-gray-400
                            "
                        >
                            Your rental has been approved and is currently active.
                        </p>


                    @elseif ($rental->status === 'Returned')

                        <p
                            class="
                                text-sm text-gray-500
                                dark:text-gray-400
                            "
                        >
                            This rental has been completed and returned.
                        </p>


                    @elseif ($rental->status === 'Late')

                        <p
                            class="
                                text-sm font-medium
                                text-red-600
                                dark:text-red-400
                            "
                        >
                            This rental has passed its expected return date.
                            Please return the equipment as soon as possible.
                        </p>


                    @elseif ($rental->status === 'Cancelled')

                        <p
                            class="
                                text-sm text-gray-500
                                dark:text-gray-400
                            "
                        >
                            This rental request was cancelled or rejected.
                        </p>

                    @endif

                </div>


                {{-- Customer Actions --}}
                @if ($rental->status === 'Pending')

                    <div
                        class="
                            mt-4 flex
                            sm:justify-end
                        "
                    >

                        <flux:button
                            size="sm"
                            variant="danger"
                            wire:click="confirmCancel({{ $rental->id }})"
                            class="w-full sm:w-auto"
                        >
                            Cancel Request
                        </flux:button>

                    </div>

                @endif

            </div>


        @empty

            {{-- Empty State --}}
            <div
                class="
                    rounded-xl
                    bg-white
                    px-4 py-12
                    text-center
                    shadow-sm
                    ring-1 ring-gray-200

                    sm:px-6
                    sm:py-16

                    dark:bg-gray-900
                    dark:ring-gray-800
                "
            >

                @if ($search || $statusFilter)

                    <h3
                        class="
                            text-lg font-semibold
                            text-gray-900
                            dark:text-white
                        "
                    >
                        No rentals found
                    </h3>

                    <p
                        class="
                            mt-2 text-sm
                            text-gray-500
                            dark:text-gray-400
                        "
                    >
                        No rentals match your current search or filter.
                    </p>

                    <div class="mt-5">

                        <flux:button
                            variant="ghost"
                            wire:click="clearFilters"
                        >
                            Clear Filters
                        </flux:button>

                    </div>


                @else

                    <h3
                        class="
                            text-lg font-semibold
                            text-gray-900
                            dark:text-white
                        "
                    >
                        No rentals yet
                    </h3>

                    <p
                        class="
                            mt-2 text-sm
                            text-gray-500
                            dark:text-gray-400
                        "
                    >
                        You haven't submitted any rental requests yet.
                    </p>

                    <div class="mt-5">

                        <a
                            href="{{ route('customer.store') }}"
                            wire:navigate
                        >
                            <flux:button
                                variant="primary"
                            >
                                Browse Equipment
                            </flux:button>
                        </a>

                    </div>

                @endif

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($rentals->hasPages())

        <div class="mt-8">
            {{ $rentals->links() }}
        </div>

    @endif


    {{-- Cancel Confirmation Modal --}}
    @if ($showCancelModal && $selectedRental)

        <div
            class="
                fixed inset-0 z-50
                flex items-end justify-center
                bg-black/50
                p-0

                sm:items-center
                sm:px-4
                sm:py-6

                dark:bg-black/70
            "
        >

            <div
                class="
                    w-full
                    rounded-t-2xl
                    bg-white p-5
                    shadow-xl

                    sm:max-w-md
                    sm:rounded-xl
                    sm:p-6

                    dark:bg-gray-900
                    dark:ring-1
                    dark:ring-gray-800
                "
            >

                <h2
                    class="
                        text-xl font-bold
                        text-gray-900
                        dark:text-white
                    "
                >
                    Cancel Rental Request
                </h2>

                <p
                    class="
                        mt-2 text-sm
                        text-gray-600
                        dark:text-gray-300
                    "
                >
                    Are you sure you want to cancel your rental request for

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

                <p
                    class="
                        mt-3 text-sm
                        text-gray-500
                        dark:text-gray-400
                    "
                >
                    This request will be marked as cancelled
                    and can no longer be approved.
                </p>


                <div
                    class="
                        mt-6 flex
                        flex-col-reverse gap-3

                        sm:flex-row
                        sm:justify-end
                    "
                >

                    <flux:button
                        variant="ghost"
                        wire:click="closeCancelModal"
                        class="w-full sm:w-auto"
                    >
                        Keep Request
                    </flux:button>


                    <flux:button
                        variant="danger"
                        wire:click="cancelRental"
                        wire:loading.attr="disabled"
                        wire:target="cancelRental"
                        class="w-full sm:w-auto"
                    >

                        <span
                            wire:loading.remove
                            wire:target="cancelRental"
                        >
                            Cancel Request
                        </span>

                        <span
                            wire:loading
                            wire:target="cancelRental"
                        >
                            Cancelling...
                        </span>

                    </flux:button>

                </div>

            </div>

        </div>

    @endif

</div>
