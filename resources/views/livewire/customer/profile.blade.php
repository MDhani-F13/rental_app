<div
    class="
        mx-auto max-w-5xl
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
            Profile
        </h2>

        <p
            class="
                mt-2 text-sm
                text-gray-600
                sm:text-base
                dark:text-gray-400
            "
        >
            Manage your personal information and password.
        </p>

    </div>


    <div class="space-y-6 sm:space-y-8">

        {{-- Profile Information --}}
        <section
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

            <div
                class="
                    border-b border-gray-100
                    pb-5
                    dark:border-gray-800
                "
            >

                <h3
                    class="
                        text-lg font-semibold
                        text-gray-900
                        dark:text-white
                    "
                >
                    Profile Information
                </h3>

                <p
                    class="
                        mt-1 text-sm
                        text-gray-500
                        dark:text-gray-400
                    "
                >
                    Update your personal and contact information.
                </p>

            </div>


            {{-- Success --}}
            @if (session('profile-success'))

                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    x-transition
                    class="
                        mt-5 rounded-lg
                        border border-green-200
                        bg-green-50
                        px-4 py-3
                        text-sm text-green-700

                        dark:border-green-900
                        dark:bg-green-950/40
                        dark:text-green-300
                    "
                >
                    {{ session('profile-success') }}
                </div>

            @endif


            <div class="mt-6 space-y-5">

                {{-- Name --}}
                <div>

                    <label
                        for="name"
                        class="
                            mb-1 block
                            text-sm font-medium
                            text-gray-700
                            dark:text-gray-300
                        "
                    >
                        Name
                    </label>

                    <input
                        id="name"
                        type="text"
                        wire:model="name"
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


                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="
                            mb-1 block
                            text-sm font-medium
                            text-gray-700
                            dark:text-gray-300
                        "
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        wire:model="email"
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

                    @error('email')

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


                {{-- Phone --}}
                <div>

                    <label
                        for="phone_number"
                        class="
                            mb-1 block
                            text-sm font-medium
                            text-gray-700
                            dark:text-gray-300
                        "
                    >
                        Phone Number
                    </label>

                    <input
                        id="phone_number"
                        type="text"
                        wire:model="phone_number"
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

                    @error('phone_number')

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


                {{-- Address --}}
                <div>

                    <label
                        for="address"
                        class="
                            mb-1 block
                            text-sm font-medium
                            text-gray-700
                            dark:text-gray-300
                        "
                    >
                        Address
                    </label>

                    <textarea
                        id="address"
                        rows="4"
                        wire:model="address"
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
                    ></textarea>

                    @error('address')

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

            </div>


            <div
                class="
                    mt-6 flex
                    sm:justify-end
                "
            >

                <flux:button
                    variant="primary"
                    wire:click="updateProfile"
                    wire:loading.attr="disabled"
                    wire:target="updateProfile"
                    class="w-full sm:w-auto"
                >

                    <span
                        wire:loading.remove
                        wire:target="updateProfile"
                    >
                        Save Changes
                    </span>

                    <span
                        wire:loading
                        wire:target="updateProfile"
                    >
                        Saving...
                    </span>

                </flux:button>

            </div>

        </section>


        {{-- Password --}}
        <section
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

            <div
                class="
                    border-b border-gray-100
                    pb-5
                    dark:border-gray-800
                "
            >

                <h3
                    class="
                        text-lg font-semibold
                        text-gray-900
                        dark:text-white
                    "
                >
                    Change Password
                </h3>

                <p
                    class="
                        mt-1 text-sm
                        text-gray-500
                        dark:text-gray-400
                    "
                >
                    Use a strong password that you don't use elsewhere.
                </p>

            </div>


            {{-- Success --}}
            @if (session('password-success'))

                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    x-transition
                    class="
                        mt-5 rounded-lg
                        border border-green-200
                        bg-green-50
                        px-4 py-3
                        text-sm text-green-700

                        dark:border-green-900
                        dark:bg-green-950/40
                        dark:text-green-300
                    "
                >
                    {{ session('password-success') }}
                </div>

            @endif


            <div class="mt-6 space-y-5">

                {{-- Current Password --}}
                <div
                    x-data="{ showPassword: false }"
                >

                    <label
                        for="current_password"
                        class="
                            mb-1 block
                            text-sm font-medium
                            text-gray-700
                            dark:text-gray-300
                        "
                    >
                        Current Password
                    </label>

                    <div class="relative">

                        <input
                            id="current_password"
                            :type="showPassword ? 'text' : 'password'"
                            wire:model="current_password"
                            autocomplete="current-password"
                            class="
                                block w-full rounded-lg
                                border border-gray-300
                                bg-white
                                px-3 py-2
                                pr-11
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

                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="
                                absolute inset-y-0 right-0
                                flex items-center
                                px-3
                                text-gray-400
                                transition-colors

                                hover:text-gray-700

                                dark:text-gray-500
                                dark:hover:text-gray-200
                            "
                            :aria-label="
                                showPassword
                                    ? 'Hide password'
                                    : 'Show password'
                            "
                        >

                            {{-- Eye --}}
                            <svg
                                x-show="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>

                            {{-- Eye Slash --}}
                            <svg
                                x-show="showPassword"
                                x-cloak
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m3 3 18 18M10.584 10.587a2 2 0 0 0 2.828 2.828M9.878 4.83A9.956 9.956 0 0 1 12 4.5c4.638 0 8.573 3.007 9.963 7.178a1.012 1.012 0 0 1 0 .639 10.03 10.03 0 0 1-1.879 3.432M6.61 6.61a10.057 10.057 0 0 0-4.573 5.073 1.012 1.012 0 0 0 0 .639C3.423 16.49 7.36 19.5 12 19.5a9.95 9.95 0 0 0 4.39-1.016"
                                />
                            </svg>

                        </button>

                    </div>

                    @error('current_password')

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


                {{-- New Password --}}
                <div
                    x-data="{ showPassword: false }"
                >

                    <label
                        for="password"
                        class="
                            mb-1 block
                            text-sm font-medium
                            text-gray-700
                            dark:text-gray-300
                        "
                    >
                        New Password
                    </label>

                    <div class="relative">

                        <input
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            wire:model="password"
                            autocomplete="new-password"
                            class="
                                block w-full rounded-lg
                                border border-gray-300
                                bg-white
                                px-3 py-2
                                pr-11
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

                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="
                                absolute inset-y-0 right-0
                                flex items-center
                                px-3
                                text-gray-400
                                transition-colors

                                hover:text-gray-700

                                dark:text-gray-500
                                dark:hover:text-gray-200
                            "
                            :aria-label="
                                showPassword
                                    ? 'Hide password'
                                    : 'Show password'
                            "
                        >

                            {{-- Eye --}}
                            <svg
                                x-show="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>

                            {{-- Eye Slash --}}
                            <svg
                                x-show="showPassword"
                                x-cloak
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m3 3 18 18M10.584 10.587a2 2 0 0 0 2.828 2.828M9.878 4.83A9.956 9.956 0 0 1 12 4.5c4.638 0 8.573 3.007 9.963 7.178a1.012 1.012 0 0 1 0 .639 10.03 10.03 0 0 1-1.879 3.432M6.61 6.61a10.057 10.057 0 0 0-4.573 5.073 1.012 1.012 0 0 0 0 .639C3.423 16.49 7.36 19.5 12 19.5a9.95 9.95 0 0 0 4.39-1.016"
                                />
                            </svg>

                        </button>

                    </div>

                    @error('password')

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


                {{-- Confirmation --}}
                <div
                    x-data="{ showPassword: false }"
                >

                    <label
                        for="password_confirmation"
                        class="
                            mb-1 block
                            text-sm font-medium
                            text-gray-700
                            dark:text-gray-300
                        "
                    >
                        Confirm New Password
                    </label>

                    <div class="relative">

                        <input
                            id="password_confirmation"
                            :type="showPassword ? 'text' : 'password'"
                            wire:model="password_confirmation"
                            autocomplete="new-password"
                            class="
                                block w-full rounded-lg
                                border border-gray-300
                                bg-white
                                px-3 py-2
                                pr-11
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

                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="
                                absolute inset-y-0 right-0
                                flex items-center
                                px-3
                                text-gray-400
                                transition-colors

                                hover:text-gray-700

                                dark:text-gray-500
                                dark:hover:text-gray-200
                            "
                            :aria-label="
                                showPassword
                                    ? 'Hide password'
                                    : 'Show password'
                            "
                        >

                            {{-- Eye --}}
                            <svg
                                x-show="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>

                            {{-- Eye Slash --}}
                            <svg
                                x-show="showPassword"
                                x-cloak
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m3 3 18 18M10.584 10.587a2 2 0 0 0 2.828 2.828M9.878 4.83A9.956 9.956 0 0 1 12 4.5c4.638 0 8.573 3.007 9.963 7.178a1.012 1.012 0 0 1 0 .639 10.03 10.03 0 0 1-1.879 3.432M6.61 6.61a10.057 10.057 0 0 0-4.573 5.073 1.012 1.012 0 0 0 0 .639C3.423 16.49 7.36 19.5 12 19.5a9.95 9.95 0 0 0 4.39-1.016"
                                />
                            </svg>

                        </button>

                    </div>

                </div>

            </div>


            <div
                class="
                    mt-6 flex
                    sm:justify-end
                "
            >

                <flux:button
                    variant="primary"
                    wire:click="updatePassword"
                    wire:loading.attr="disabled"
                    wire:target="updatePassword"
                    class="w-full sm:w-auto"
                >

                    <span
                        wire:loading.remove
                        wire:target="updatePassword"
                    >
                        Update Password
                    </span>

                    <span
                        wire:loading
                        wire:target="updatePassword"
                    >
                        Updating...
                    </span>

                </flux:button>

            </div>

        </section>

        {{-- Appearance --}}
        <section
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

            <div
                class="
                    border-b border-gray-100
                    pb-5
                    dark:border-gray-800
                "
            >

                <h3
                    class="
                        text-lg font-semibold
                        text-gray-900
                        dark:text-white
                    "
                >
                    Appearance
                </h3>

                <p
                    class="
                        mt-1 text-sm
                        text-gray-500
                        dark:text-gray-400
                    "
                >
                    Choose how the application looks on this device.
                </p>

            </div>


            <div class="mt-6">

                <flux:radio.group
                    x-data
                    x-model="$flux.appearance"
                    variant="segmented"
                >

                    <flux:radio
                        value="light"
                        icon="sun"
                    >
                        Light
                    </flux:radio>

                    <flux:radio
                        value="dark"
                        icon="moon"
                    >
                        Dark
                    </flux:radio>

                    <flux:radio
                        value="system"
                        icon="computer-desktop"
                    >
                        System
                    </flux:radio>

                </flux:radio.group>

            </div>

        </section>

    </div>

</div>
