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
                text-2xl font-bold text-gray-900
                sm:text-3xl
                dark:text-white
            "
        >
            Equipment
        </h2>

        <p
            class="
                mt-2 text-sm text-gray-600
                sm:text-base
                dark:text-gray-400
            "
        >
            Browse equipment available for rental.
        </p>

    </div>


    {{-- Success Notification --}}
    @if (session('success'))

        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition
            class="mb-6 flex items-center justify-between
                rounded-lg
                border border-green-200
                bg-green-50
                px-4 py-3
                text-sm text-green-700

                dark:border-green-900
                dark:bg-green-950/40
                dark:text-green-300"
        >

            <span>
                {{ session('success') }}
            </span>

            <button
                type="button"
                @click="show = false"
                class="ml-4 font-medium hover:text-green-900 dark:hover:text-green-100"
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
            shadow-sm ring-1 ring-gray-200
            sm:mb-8 sm:p-5

            dark:bg-gray-900
            dark:ring-gray-800
        "
    >

        <div
            class="grid gap-4
                   md:grid-cols-[1fr_220px_200px_auto]"
        >

            {{-- Search --}}
            <div>

                <label
                    for="store-search"
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
                    id="store-search"
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


            {{-- Category --}}
            <div>

                <label
                    for="store-category"
                    class="
                        mb-1 block
                        text-sm font-medium
                        text-gray-700
                        dark:text-gray-300
                    "
                >
                    Category
                </label>

                <select
                    id="store-category"
                    wire:model.live="categoryFilter"
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
                        All Categories
                    </option>

                    @foreach ($categories as $category)

                        <option value="{{ $category }}">
                            {{ $category }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Availability --}}
            <div>

                <label
                    for="store-availability"
                    class="
                        mb-1 block
                        text-sm font-medium
                        text-gray-700
                        dark:text-gray-300
                    "
                >
                    Availability
                </label>

                <select
                    id="store-availability"
                    wire:model.live="availabilityFilter"
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
                        All Equipment
                    </option>

                    <option value="available">
                        Available
                    </option>

                    <option value="out_of_stock">
                        Out of Stock
                    </option>

                </select>

            </div>


            {{-- Clear --}}
            <div class="flex items-end">

                <flux:button
                    variant="ghost"
                    wire:click="clearFilters"
                >
                    Clear Filters
                </flux:button>

            </div>

        </div>

    </div>


    {{-- Equipment Grid --}}
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        @forelse ($equipment as $item)

            <div
                class="
                    flex flex-col overflow-hidden
                    rounded-xl
                    bg-white
                    shadow-sm
                    ring-1 ring-gray-200
                    transition

                    hover:-translate-y-0.5
                    hover:shadow-md

                    dark:bg-gray-900
                    dark:ring-gray-800
                "
            >

                {{-- Equipment Image --}}
                @if ($item->picture)

                    <img
                        src="{{ asset('storage/' . $item->picture) }}"
                        alt="{{ $item->name }}"
                        class="h-52 w-full object-cover"
                    >

                @else

                    <div
                        class="flex h-52 items-center
                               justify-center bg-gray-100"
                    >
                        <span class="text-sm text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                            No image
                        </span>
                    </div>

                @endif


                {{-- Card Content --}}
                <div class="flex flex-1 flex-col p-5">

                    <div class="flex-1">

                        <div
                            class="flex items-start
                                   justify-between gap-3"
                        >

                            <div>

                                <h3
                                class="
                                    text-lg font-semibold
                                    text-gray-900
                                    dark:text-white
                                "
                                >
                                    {{ $item->name }}
                                </h3>

                                <p
                                    class="
                                        mt-1 text-sm
                                        text-gray-500
                                        dark:text-gray-400
                                    "
                                >
                                    {{ $item->category }}
                                </p>

                            </div>


                            {{-- Stock Badge --}}
                            @if ($item->stock <= 0)

                                <span
                                    class="
                                        shrink-0 rounded-full
                                        bg-red-100 px-2.5 py-1
                                        text-xs font-semibold text-red-700

                                        dark:bg-red-900/30
                                        dark:text-red-300
                                    "
                                >
                                    Out of Stock
                                </span>

                            @elseif ($item->stock <= 5)

                                <span
                                    class="
                                        shrink-0 rounded-full
                                        bg-yellow-100 px-2.5 py-1
                                        text-xs font-semibold text-yellow-700

                                        dark:bg-yellow-900/30
                                        dark:text-yellow-300
                                    "
                                >
                                    {{ $item->stock }} left
                                </span>

                            @else

                                <span
                                    class="
                                        shrink-0 rounded-full
                                        bg-green-100 px-2.5 py-1
                                        text-xs font-semibold text-green-700

                                        dark:bg-green-900/30
                                        dark:text-green-300
                                    "
                                >
                                    Available
                                </span>

                            @endif

                        </div>


                        {{-- Description --}}
                        <p
                            class="
                                mt-4 line-clamp-3
                                text-sm leading-6
                                text-gray-600
                                dark:text-gray-300
                            "
                        >
                            {{ $item->description }}
                        </p>

                    </div>


                    {{-- Price + Rent Button --}}
                    <div
                        class="
                            mt-6 border-t
                            border-gray-100 pt-4
                            dark:border-gray-800
                        "
                    >

                        <div
                            class="flex items-end
                                   justify-between gap-4"
                        >

                            <div>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Rental price
                                </p>

                                <p
                                    class="
                                        mt-1 text-lg font-bold
                                        text-gray-900
                                        dark:text-white
                                    "
                                >
                                    Rp {{ number_format(
                                        $item->price,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </p>

                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                    per day
                                </p>

                            </div>


                            <flux:button
                                variant="primary"
                                wire:click="rent({{ $item->id }})"
                                :disabled="$item->stock <= 0"
                            >
                                {{ $item->stock > 0
                                    ? 'Rent Now'
                                    : 'Unavailable'
                                }}
                            </flux:button>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            {{-- Empty Result --}}
            <div
                class="
                    col-span-full
                    rounded-xl
                    bg-white
                    p-8 text-center
                    shadow-sm
                    ring-1 ring-gray-200
                    sm:p-12

                    dark:bg-gray-900
                    dark:ring-gray-800
                "
            >

                <h3
                    class="
                        text-lg font-semibold
                        text-gray-900
                        dark:text-white
                    "
                >
                    No equipment found
                </h3>

                <p class="
                        mt-2 text-sm
                        text-gray-500
                        dark:text-gray-400
                    ">
                    Try changing your search or filters.
                </p>


                @if (
                    $search ||
                    $categoryFilter ||
                    $availabilityFilter
                )

                    <div class="mt-5">

                        <flux:button
                            variant="ghost"
                            wire:click="clearFilters"
                        >
                            Clear Filters
                        </flux:button>

                    </div>

                @endif

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if ($equipment->hasPages())

        <div class="mt-8">
            {{ $equipment->links() }}
        </div>

    @endif


    {{-- Rental Modal --}}
    @if ($showRentalForm && $selectedEquipment)

        <div
            class="
                fixed inset-0 z-50
                flex items-end justify-center
                bg-black/50
                p-0
                sm:items-center
                sm:px-4 sm:py-6
                dark:bg-black/70
            "
        >

            <div
                class="
                    max-h-[92vh] w-full
                    overflow-y-auto
                    rounded-t-2xl
                    bg-white
                    p-5
                    shadow-xl

                    sm:max-w-lg
                    sm:rounded-xl
                    sm:p-6

                    dark:bg-gray-900
                    dark:ring-1
                    dark:ring-gray-800
                "
            >

                {{-- Modal Header --}}
                <div class="mb-6">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Rent Equipment
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Select your quantity and rental period.
                    </p>

                </div>


                {{-- Selected Equipment --}}
                <div
                    class="
                        mb-6 flex items-center gap-4
                        rounded-lg
                        bg-gray-50 p-4
                        dark:bg-gray-800
                    "
                >

                    @if ($selectedEquipment->picture)

                        <img
                            src="{{ asset(
                                'storage/' .
                                $selectedEquipment->picture
                            ) }}"
                            alt="{{ $selectedEquipment->name }}"
                            class="h-20 w-20
                                   rounded-lg object-cover"
                        >

                    @else

                        <div
                            class="
                                flex h-20 w-20 shrink-0
                                items-center justify-center
                                rounded-lg
                                bg-gray-200
                                dark:bg-gray-700
                            "
                        >
                            <span
                                class="text-xs text-gray-400"
                            >
                                No image
                            </span>
                        </div>

                    @endif


                    <div>

                        <h3
                            class="
                                font-semibold
                                text-gray-900
                                dark:text-white
                            "
                        >
                            {{ $selectedEquipment->name }}
                        </h3>

                        <p
                            class="
                                mt-1 text-sm
                                text-gray-500
                                dark:text-gray-400
                            "
                        >
                            {{ $selectedEquipment->category }}
                        </p>

                        <p
                            class="
                                mt-2 text-sm font-medium
                                text-gray-900
                                dark:text-gray-100
                            "
                        >
                            Rp {{ number_format(
                                $selectedEquipment->price,
                                0,
                                ',',
                                '.'
                            ) }}
                            / day
                        </p>

                    </div>

                </div>


                {{-- Rental Form --}}
                <div class="space-y-5">

                    {{-- Quantity --}}
                    <div>

                        <label
                            for="quantity"
                            class="
                                mb-1 block
                                text-sm font-medium
                                text-gray-700
                                dark:text-gray-300
                            "
                        >
                            Quantity
                        </label>

                        <input
                            id="quantity"
                            type="number"
                            min="1"
                            max="{{ $this->availableQuantity }}"
                            wire:model.live="quantity"
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

                        @if (
                            $rentDate &&
                            $returnDate &&
                            $this->availableQuantity > 0
                        )

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ $this->availableQuantity }}
                                unit(s) available for the selected dates.
                            </p>

                        @elseif (
                            $rentDate &&
                            $returnDate
                        )

                            <p class="
                                    mt-1 text-xs font-medium
                                    text-red-600
                                    dark:text-red-400
                                ">
                                Fully booked for the selected dates.
                            </p>

                        @endif


                        @error('quantity')

                            <p class="
                                    mt-1 text-sm
                                    text-red-600
                                    dark:text-red-400
                                ">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Rent Date --}}
                    <div>

                        <label
                            for="rent-date"
                            class="
                                mb-1 block
                                text-sm font-medium
                                text-gray-700
                                dark:text-gray-300
                            "
                        >
                            Rent Date
                        </label>

                        <input
                            id="rent-date"
                            type="date"
                            min="{{ now()->format('Y-m-d') }}"
                            wire:model.live="rentDate"
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

                        @error('rentDate')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Return Date --}}
                    <div>

                        <label
                            for="return-date"
                            class="
                                mb-1 block
                                text-sm font-medium
                                text-gray-700
                                dark:text-gray-300
                            "
                        >
                            Return Date
                        </label>

                        <input
                            id="return-date"
                            type="date"
                            min="{{ $rentDate ?: now()->format('Y-m-d') }}"
                            wire:model.live="returnDate"
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

                        @error('returnDate')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- Price Summary --}}
                <div
                    class="
                        mt-6 rounded-lg
                        border border-gray-200 dark:border-gray-700
                        bg-gray-50 p-4

                        dark:border-gray-700
                        dark:bg-gray-800
                    "
                >

                    <div
                        class="flex justify-between
                               text-gray-600 dark:text-gray-300"
                    >
                        <span>
                            Price / day
                        </span>

                        <span>
                            Rp {{ number_format(
                                $selectedEquipment->price,
                                0,
                                ',',
                                '.'
                            ) }}
                        </span>
                    </div>


                    <div
                        class="mt-2 flex justify-between
                               text-gray-600 dark:text-gray-300"
                    >
                        <span>
                            Quantity
                        </span>

                        <span>
                            {{ max(1, (int) $quantity) }}
                        </span>
                    </div>


                    <div
                        class="mt-2 flex justify-between
                               text-gray-600 dark:text-gray-300"
                    >
                        <span>
                            Rental duration
                        </span>

                        <span>
                            {{ $this->rentalDays }}
                            day(s)
                        </span>
                    </div>


                    <div
                        class="mt-4 flex items-center
                               justify-between
                               border-t border-gray-200 dark:border-gray-700
                               pt-4"
                    >

                        <span
                            class="font-medium text-gray-900 dark:text-white"
                        >
                            Estimated Total
                        </span>

                        <span
                            class="text-lg font-bold
                                   text-gray-900 dark:text-white"
                        >
                            Rp {{ number_format(
                                $this->estimatedTotal,
                                0,
                                ',',
                                '.'
                            ) }}
                        </span>

                    </div>

                </div>


                {{-- Modal Actions --}}
                <div
                    class="
                        mt-6 flex flex-col-reverse gap-3
                        sm:flex-row
                        sm:justify-end
                    "
                >

                    <flux:button
                        variant="ghost"
                        wire:click="cancelRental"
                        class="w-full sm:w-auto"
                    >
                        Cancel
                    </flux:button>


                    <flux:button
                        variant="primary"
                        wire:click="createRental"
                        wire:loading.attr="disabled"
                        wire:target="createRental"
                        class="w-full sm:w-auto"
                    >

                        <span
                            wire:loading.remove
                            wire:target="createRental"
                        >
                            Submit Rental Request
                        </span>

                        <span
                            wire:loading
                            wire:target="createRental"
                        >
                            Submitting...
                        </span>

                    </flux:button>

                </div>

            </div>

        </div>

    @endif

</div>

