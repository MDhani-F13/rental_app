@extends('customer.layouts.auth')

@section('title', 'Create Customer Account')

@section('content')

    <div class="mb-8">

        <h2
            class="
                text-2xl font-semibold
                text-gray-900
                dark:text-white
            "
        >
            Create your account
        </h2>

        <p
            class="
                mt-2 text-sm
                text-gray-600
                dark:text-gray-400
            "
        >
            Register as a customer to start renting equipment.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div
            class="
                mb-6 rounded-lg
                border border-red-200
                bg-red-50
                px-4 py-3
                text-sm text-red-700

                dark:border-red-900
                dark:bg-red-950/40
                dark:text-red-300
            "
        >

            <ul class="list-disc space-y-1 pl-5">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('customer.register.submit') }}"
        class="space-y-5"
    >

        @csrf


        {{-- Name --}}
        <div>

            <label
                for="name"
                class="
                    mb-2 block
                    text-sm font-medium
                    text-gray-700
                    dark:text-gray-300
                "
            >
                Full name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="John Doe"
                class="
                    block w-full rounded-lg
                    border border-gray-300
                    bg-white
                    px-4 py-2.5
                    text-sm text-gray-900
                    outline-none
                    transition

                    placeholder:text-gray-400

                    focus:border-gray-900
                    focus:ring-2
                    focus:ring-gray-900/10

                    dark:border-gray-700
                    dark:bg-gray-800
                    dark:text-gray-100
                    dark:placeholder:text-gray-500
                    dark:focus:border-gray-500
                    dark:focus:ring-gray-500/20
                "
            >

        </div>


        {{-- Email --}}
        <div>

            <label
                for="email"
                class="
                    mb-2 block
                    text-sm font-medium
                    text-gray-700
                    dark:text-gray-300
                "
            >
                Email address
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                placeholder="you@example.com"
                class="
                    block w-full rounded-lg
                    border border-gray-300
                    bg-white
                    px-4 py-2.5
                    text-sm text-gray-900
                    outline-none
                    transition

                    placeholder:text-gray-400

                    focus:border-gray-900
                    focus:ring-2
                    focus:ring-gray-900/10

                    dark:border-gray-700
                    dark:bg-gray-800
                    dark:text-gray-100
                    dark:placeholder:text-gray-500
                    dark:focus:border-gray-500
                    dark:focus:ring-gray-500/20
                "
            >

        </div>


        {{-- Phone --}}
        <div>

            <label
                for="phone_number"
                class="
                    mb-2 block
                    text-sm font-medium
                    text-gray-700
                    dark:text-gray-300
                "
            >
                Phone number
            </label>

            <input
                type="tel"
                id="phone_number"
                name="phone_number"
                value="{{ old('phone_number') }}"
                required
                autocomplete="tel"
                placeholder="08123456789"
                class="
                    block w-full rounded-lg
                    border border-gray-300
                    bg-white
                    px-4 py-2.5
                    text-sm text-gray-900
                    outline-none
                    transition

                    placeholder:text-gray-400

                    focus:border-gray-900
                    focus:ring-2
                    focus:ring-gray-900/10

                    dark:border-gray-700
                    dark:bg-gray-800
                    dark:text-gray-100
                    dark:placeholder:text-gray-500
                    dark:focus:border-gray-500
                    dark:focus:ring-gray-500/20
                "
            >

        </div>


        {{-- Address --}}
        <div>

            <label
                for="address"
                class="
                    mb-2 block
                    text-sm font-medium
                    text-gray-700
                    dark:text-gray-300
                "
            >
                Address
            </label>

            <textarea
                id="address"
                name="address"
                rows="3"
                required
                autocomplete="street-address"
                placeholder="Enter your full address"
                class="
                    block w-full resize-none rounded-lg
                    border border-gray-300
                    bg-white
                    px-4 py-2.5
                    text-sm text-gray-900
                    outline-none
                    transition

                    placeholder:text-gray-400

                    focus:border-gray-900
                    focus:ring-2
                    focus:ring-gray-900/10

                    dark:border-gray-700
                    dark:bg-gray-800
                    dark:text-gray-100
                    dark:placeholder:text-gray-500
                    dark:focus:border-gray-500
                    dark:focus:ring-gray-500/20
                "
            >{{ old('address') }}</textarea>

        </div>


        {{-- Password --}}
        <div
            x-data="{ showPassword: false }"
        >

            <label
                for="password"
                class="
                    mb-2 block
                    text-sm font-medium
                    text-gray-700
                    dark:text-gray-300
                "
            >
                Password
            </label>

            <div class="relative">

                <input
                    :type="showPassword ? 'text' : 'password'"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="At least 8 characters"
                    class="
                        block w-full rounded-lg
                        border border-gray-300
                        bg-white
                        px-4 py-2.5
                        pr-12
                        text-sm text-gray-900
                        outline-none
                        transition

                        placeholder:text-gray-400

                        focus:border-gray-900
                        focus:ring-2
                        focus:ring-gray-900/10

                        dark:border-gray-700
                        dark:bg-gray-800
                        dark:text-gray-100
                        dark:placeholder:text-gray-500
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


        {{-- Confirm Password --}}
        <div
            x-data="{ showPassword: false }"
        >

            <label
                for="password_confirmation"
                class="
                    mb-2 block
                    text-sm font-medium
                    text-gray-700
                    dark:text-gray-300
                "
            >
                Confirm password
            </label>

            <div class="relative">

                <input
                    :type="showPassword ? 'text' : 'password'"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your password again"
                    class="
                        block w-full rounded-lg
                        border border-gray-300
                        bg-white
                        px-4 py-2.5
                        pr-12
                        text-sm text-gray-900
                        outline-none
                        transition

                        placeholder:text-gray-400

                        focus:border-gray-900
                        focus:ring-2
                        focus:ring-gray-900/10

                        dark:border-gray-700
                        dark:bg-gray-800
                        dark:text-gray-100
                        dark:placeholder:text-gray-500
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


        {{-- Submit --}}
        <button
            type="submit"
            class="
                w-full rounded-lg
                bg-gray-900
                px-4 py-2.5
                text-sm font-semibold
                text-white
                transition

                hover:bg-gray-800

                focus:outline-none
                focus:ring-2
                focus:ring-gray-900
                focus:ring-offset-2

                dark:bg-white
                dark:text-gray-900
                dark:hover:bg-gray-200
                dark:focus:ring-white
                dark:focus:ring-offset-gray-900
            "
        >
            Create account
        </button>

    </form>


    {{-- Login --}}
    <div
        class="
            mt-6 border-t
            border-gray-200
            pt-6 text-center

            dark:border-gray-800
        "
    >

        <p
            class="
                text-sm text-gray-600
                dark:text-gray-400
            "
        >
            Already have an account?

            <a
                href="{{ route('customer.login') }}"
                class="
                    font-semibold
                    text-gray-900

                    hover:underline

                    dark:text-white
                "
            >
                Sign in
            </a>
        </p>

    </div>

@endsection