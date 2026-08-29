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

    <div
        class="
            flex flex-col gap-4

            sm:flex-row
            sm:items-center
            sm:justify-between
        "
    >

        <div>

            <h1
                class="
                    text-2xl font-bold
                    text-gray-900

                    sm:text-3xl

                    dark:text-white
                "
            >
                Equipment
            </h1>

            <p
                class="
                    mt-2 text-sm
                    text-gray-600

                    sm:text-base

                    dark:text-zinc-400
                "
            >
                Manage rental equipment, pricing, and stock.
            </p>

        </div>


        <flux:button
            variant="primary"
            wire:click="create"
            class="w-full sm:w-auto"
        >
            Add Equipment
        </flux:button>

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


    @if (session('error'))

        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 6000)"
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
                {{ session('error') }}
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

    @endif


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

                lg:grid-cols-[minmax(240px,1fr)_220px_180px_auto]
            "
        >

            {{-- Search --}}
            <div class="sm:col-span-2 lg:col-span-1">

                <label
                    for="equipment-search"
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
                    id="equipment-search"
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search equipment..."
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


            {{-- Category Filter --}}
            <div>

                <label
                    for="category-filter"
                    class="
                        mb-1.5 block
                        text-sm font-medium
                        text-gray-700

                        dark:text-zinc-300
                    "
                >
                    Category
                </label>

                <select
                    id="category-filter"
                    wire:model.live="categoryFilter"
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
                        All Categories
                    </option>

                    @foreach ($categories as $category)

                        <option value="{{ $category }}">
                            {{ $category }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Stock Filter --}}
            <div>

                <label
                    for="stock-filter"
                    class="
                        mb-1.5 block
                        text-sm font-medium
                        text-gray-700

                        dark:text-zinc-300
                    "
                >
                    Stock
                </label>

                <select
                    id="stock-filter"
                    wire:model.live="stockFilter"
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
                        All Stock
                    </option>

                    <option value="in_stock">
                        In Stock
                    </option>

                    <option value="low_stock">
                        Low Stock
                    </option>

                    <option value="out_of_stock">
                        Out of Stock
                    </option>

                </select>

            </div>


            {{-- Clear --}}
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
    {{-- Equipment Table --}}
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
                    min-w-[900px] w-full
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
                            Category
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
                            Price / Day
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
                            Stock
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
                        dark:divide-zinc-800
                    "
                >

                    @forelse ($equipment as $item)

                        <tr
                            class="
                                transition-colors
                                hover:bg-gray-50
                                dark:hover:bg-zinc-800/60
                            "
                        >

                            {{-- Equipment --}}
                            <td
                                class="
                                    px-4 py-4
                                    sm:px-6
                                "
                            >

                                <div class="flex items-center gap-3 sm:gap-4">

                                    @if ($item->picture)

                                        <img
                                            src="{{ asset(
                                                'storage/' . $item->picture
                                            ) }}"
                                            alt="{{ $item->name }}"
                                            class="
                                                h-12 w-12
                                                shrink-0
                                                rounded-lg
                                                object-cover

                                                sm:h-14 sm:w-14
                                            "
                                        >

                                    @else

                                        <div
                                            class="
                                                flex h-12 w-12
                                                shrink-0
                                                items-center justify-center
                                                rounded-lg
                                                bg-gray-100

                                                sm:h-14 sm:w-14

                                                dark:bg-zinc-800
                                            "
                                        >

                                            <span
                                                class="
                                                    text-center text-[10px]
                                                    text-gray-400

                                                    dark:text-zinc-500
                                                "
                                            >
                                                No image
                                            </span>

                                        </div>

                                    @endif


                                    <div class="min-w-0">

                                        <div
                                            class="
                                                max-w-[260px]
                                                truncate
                                                font-medium
                                                text-gray-900

                                                dark:text-white
                                            "
                                        >
                                            {{ $item->name }}
                                        </div>

                                        <div
                                            class="
                                                mt-1 max-w-[260px]
                                                truncate
                                                text-sm text-gray-500

                                                dark:text-zinc-400
                                            "
                                        >
                                            {{ $item->description }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-sm text-gray-700

                                    sm:px-6

                                    dark:text-zinc-300
                                "
                            >
                                {{ $item->category }}
                            </td>


                            {{-- Price --}}
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
                                    $item->price,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </td>


                            {{-- Stock --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4

                                    sm:px-6
                                "
                            >

                                @if ($item->stock === 0)

                                    <span
                                        class="
                                            inline-flex rounded-full
                                            bg-red-100
                                            px-3 py-1
                                            text-xs font-semibold
                                            text-red-700

                                            dark:bg-red-950/50
                                            dark:text-red-300
                                        "
                                    >
                                        Out of Stock
                                    </span>

                                @elseif ($item->stock <= 5)

                                    <div>

                                        <span
                                            class="
                                                inline-flex rounded-full
                                                bg-yellow-100
                                                px-3 py-1
                                                text-xs font-semibold
                                                text-yellow-700

                                                dark:bg-yellow-950/50
                                                dark:text-yellow-300
                                            "
                                        >
                                            Low Stock
                                        </span>

                                        <p
                                            class="
                                                mt-1 text-xs
                                                text-gray-500

                                                dark:text-zinc-500
                                            "
                                        >
                                            {{ $item->stock }} remaining
                                        </p>

                                    </div>

                                @else

                                    <div>

                                        <span
                                            class="
                                                inline-flex rounded-full
                                                bg-green-100
                                                px-3 py-1
                                                text-xs font-semibold
                                                text-green-700

                                                dark:bg-green-950/50
                                                dark:text-green-300
                                            "
                                        >
                                            In Stock
                                        </span>

                                        <p
                                            class="
                                                mt-1 text-xs
                                                text-gray-500

                                                dark:text-zinc-500
                                            "
                                        >
                                            {{ $item->stock }} available
                                        </p>

                                    </div>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4

                                    sm:px-6
                                "
                            >

                                <div class="flex justify-end gap-2">

                                    <flux:button
                                        size="sm"
                                        variant="ghost"
                                        wire:click="edit({{ $item->id }})"
                                    >
                                        Edit
                                    </flux:button>

                                    <flux:button
                                        size="sm"
                                        variant="danger"
                                        wire:click="confirmDelete({{ $item->id }})"
                                    >
                                        Delete
                                    </flux:button>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="5"
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
                                    No equipment matches your filters.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($equipment->hasPages())

            <div
                class="
                    border-t border-gray-200
                    px-4 py-4

                    sm:px-6

                    dark:border-zinc-700
                "
            >
                {{ $equipment->links() }}
            </div>

        @endif

    </section>


    {{-- ========================================================= --}}
    {{-- Create / Edit Form --}}
    {{-- ========================================================= --}}

    @if ($showForm)

        <div
            class="
                fixed inset-0 z-50
                flex items-end justify-center
                bg-black/60

                sm:items-center
                sm:px-4 sm:py-6
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

                    sm:max-w-xl
                    sm:rounded-xl
                    sm:p-6

                    dark:bg-zinc-900
                    dark:ring-1
                    dark:ring-zinc-700
                "
            >

                {{-- Header --}}
                <div
                    class="
                        mb-6
                        border-b border-gray-100
                        pb-5

                        dark:border-zinc-800
                    "
                >

                    <h2
                        class="
                            text-xl font-bold
                            text-gray-900

                            dark:text-white
                        "
                    >
                        {{ $editingId
                            ? 'Edit Equipment'
                            : 'Add Equipment'
                        }}
                    </h2>

                    <p
                        class="
                            mt-1 text-sm
                            text-gray-500

                            dark:text-zinc-400
                        "
                    >
                        {{ $editingId
                            ? 'Update the equipment information below.'
                            : 'Enter the equipment information below.'
                        }}
                    </p>

                </div>


                <div class="space-y-5">

                    {{-- Name --}}
                    <div>

                        <flux:input
                            wire:model="name"
                            label="Equipment Name"
                            placeholder="e.g. Canon EOS R6"
                        />

                        @error('name')
                            <p
                                class="
                                    mt-1 text-sm
                                    text-red-600

                                    dark:text-red-400
                                "
                            >
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Description --}}
                    <div>

                        <label
                            for="equipment-description"
                            class="
                                mb-1.5 block
                                text-sm font-medium
                                text-gray-700

                                dark:text-zinc-300
                            "
                        >
                            Description
                        </label>

                        <textarea
                            id="equipment-description"
                            wire:model="description"
                            rows="4"
                            placeholder="Describe the equipment..."
                            class="
                                block w-full
                                resize-y
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
                        ></textarea>

                        @error('description')
                            <p
                                class="
                                    mt-1 text-sm
                                    text-red-600

                                    dark:text-red-400
                                "
                            >
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Price --}}
                    <div>

                        <x-currency-input
                            wire:model="price"
                            label="Rental Price / Day"
                            placeholder="e.g. 250.000"
                        />

                        @error('price')
                            <p
                                class="
                                    mt-1 text-sm
                                    text-red-600

                                    dark:text-red-400
                                "
                            >
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Stock --}}
                    <div>

                        <flux:input
                            wire:model="stock"
                            type="number"
                            min="0"
                            label="Stock"
                            placeholder="e.g. 10"
                        />

                        @error('stock')
                            <p
                                class="
                                    mt-1 text-sm
                                    text-red-600

                                    dark:text-red-400
                                "
                            >
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Category --}}
                    <div>

                        <flux:input
                            wire:model="category"
                            label="Category"
                            placeholder="e.g. Camera"
                        />

                        @error('category')
                            <p
                                class="
                                    mt-1 text-sm
                                    text-red-600

                                    dark:text-red-400
                                "
                            >
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Existing Picture --}}
                    @if (
                        $editingId &&
                        !$picture &&
                        $existingPicture
                    )

                        <div>

                            <p
                                class="
                                    mb-2 text-sm font-medium
                                    text-gray-700

                                    dark:text-zinc-300
                                "
                            >
                                Current Picture
                            </p>

                            <img
                                src="{{ asset(
                                    'storage/' . $existingPicture
                                ) }}"
                                alt="{{ $name }}"
                                class="
                                    h-32 w-32
                                    rounded-lg
                                    object-cover
                                    ring-1 ring-gray-200

                                    dark:ring-zinc-700
                                "
                            >

                        </div>

                    @endif


                    {{-- Picture Upload --}}
                    <div>

                        <label
                            for="equipment-picture"
                            class="
                                mb-1.5 block
                                text-sm font-medium
                                text-gray-700

                                dark:text-zinc-300
                            "
                        >
                            {{ $editingId
                                ? 'Replace Picture'
                                : 'Picture'
                            }}
                        </label>

                        <input
                            id="equipment-picture"
                            type="file"
                            wire:model="picture"
                            accept="image/*"
                            class="
                                block w-full
                                text-sm text-gray-600

                                file:mr-4
                                file:rounded-lg
                                file:border-0
                                file:bg-gray-100
                                file:px-4 file:py-2
                                file:text-sm
                                file:font-medium
                                file:text-gray-700

                                hover:file:bg-gray-200

                                dark:text-zinc-400
                                dark:file:bg-zinc-800
                                dark:file:text-zinc-300

                                dark:hover:file:bg-zinc-700
                            "
                        >

                        <p
                            class="
                                mt-1.5 text-xs
                                text-gray-500

                                dark:text-zinc-500
                            "
                        >
                            JPG, PNG or WebP. Maximum 2 MB.
                        </p>

                        @error('picture')
                            <p
                                class="
                                    mt-1 text-sm
                                    text-red-600

                                    dark:text-red-400
                                "
                            >
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- New Picture Preview --}}
                    @if ($picture)

                        <div>

                            <p
                                class="
                                    mb-2 text-sm font-medium
                                    text-gray-700

                                    dark:text-zinc-300
                                "
                            >
                                New Picture Preview
                            </p>

                            <img
                                src="{{ $picture->temporaryUrl() }}"
                                class="
                                    h-32 w-32
                                    rounded-lg
                                    object-cover
                                    ring-1 ring-gray-200

                                    dark:ring-zinc-700
                                "
                                alt="Equipment preview"
                            >

                        </div>

                    @endif

                </div>


                {{-- Actions --}}
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
                        wire:click="cancelForm"
                        class="w-full sm:w-auto"
                    >
                        Cancel
                    </flux:button>


                    @if ($editingId)

                        <flux:button
                            variant="primary"
                            wire:click="update"
                            wire:loading.attr="disabled"
                            wire:target="update"
                            class="w-full sm:w-auto"
                        >

                            <span
                                wire:loading.remove
                                wire:target="update"
                            >
                                Update Equipment
                            </span>

                            <span
                                wire:loading
                                wire:target="update"
                            >
                                Updating...
                            </span>

                        </flux:button>

                    @else

                        <flux:button
                            variant="primary"
                            wire:click="store"
                            wire:loading.attr="disabled"
                            wire:target="store"
                            class="w-full sm:w-auto"
                        >

                            <span
                                wire:loading.remove
                                wire:target="store"
                            >
                                Add Equipment
                            </span>

                            <span
                                wire:loading
                                wire:target="store"
                            >
                                Saving...
                            </span>

                        </flux:button>

                    @endif

                </div>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- Delete Confirmation Modal --}}
    {{-- ========================================================= --}}

    @if ($deletingId)

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

                <h2
                    class="
                        text-xl font-bold
                        text-gray-900

                        dark:text-white
                    "
                >
                    Delete Equipment
                </h2>

                <p
                    class="
                        mt-2 text-sm
                        text-gray-600

                        dark:text-zinc-300
                    "
                >
                    Are you sure you want to delete
                    <span
                        class="
                            font-semibold
                            text-gray-900

                            dark:text-white
                        "
                    >
                        {{ $deletingName }}
                    </span>?
                </p>

                <p
                    class="
                        mt-3 text-sm
                        text-gray-500

                        dark:text-zinc-400
                    "
                >
                    Equipment with existing rental history cannot be deleted.
                </p>


                <div
                    class="
                        mt-6
                        flex flex-col-reverse gap-2

                        sm:flex-row
                        sm:justify-end
                        sm:gap-3
                    "
                >

                    <flux:button
                        variant="ghost"
                        wire:click="cancelDelete"
                        class="w-full sm:w-auto"
                    >
                        Cancel
                    </flux:button>


                    <flux:button
                        variant="danger"
                        wire:click="delete({{ $deletingId }})"
                        wire:loading.attr="disabled"
                        wire:target="delete"
                        class="w-full sm:w-auto"
                    >

                        <span
                            wire:loading.remove
                            wire:target="delete"
                        >
                            Delete Equipment
                        </span>

                        <span
                            wire:loading
                            wire:target="delete"
                        >
                            Deleting...
                        </span>

                    </flux:button>

                </div>

            </div>

        </div>

    @endif

</div>