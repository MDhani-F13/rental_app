@extends('customer.layouts.auth')

@section('title', 'Customer Login')

@section('content')

    <div class="mb-8">

        <h2
            class="
                text-2xl font-semibold
                text-gray-900
                dark:text-white
            "
        >
            Welcome back
        </h2>

        <p
            class="
                mt-2 text-sm
                text-gray-600
                dark:text-gray-400
            "
        >
            Sign in to your customer account to continue.
        </p>

    </div>


    {{-- Status --}}
    @if (session('status'))

        <div
            class="
                mb-6 rounded-lg
                border border-green-200
                bg-green-50
                px-4 py-3
                text-sm text-green-700

                dark:border-green-900
                dark:bg-green-950/40
                dark:text-green-300
            "
        >
            {{ session('status') }}
        </div>

    @endif


    {{-- Success --}}
    @if (session('success'))

        <div
            class="
                mb-6 rounded-lg
                border border-green-200
                bg-green-50
                px-4 py-3
                text-sm text-green-700

                dark:border-green-900
                dark:bg-green-950/40
                dark:text-green-300
            "
        >
            {{ session('success') }}
        </div>

    @endif


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
        action="{{ route('customer.login.submit') }}"
        class="space-y-5"
    >

        @csrf


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
                autofocus
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
                    autocomplete="current-password"
                    placeholder="Enter your password"
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


                {{-- Password Visibility Toggle --}}
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


        {{-- Remember --}}
        <div class="flex items-center">

            <input
                type="checkbox"
                id="remember"
                name="remember"
                class="
                    h-4 w-4 rounded
                    border-gray-300
                    text-gray-900

                    focus:ring-gray-900

                    dark:border-gray-600
                    dark:bg-gray-800
                    dark:text-white
                    dark:focus:ring-gray-500
                "
            >

            <label
                for="remember"
                class="
                    ml-2 text-sm
                    text-gray-600
                    dark:text-gray-400
                "
            >
                Remember me
            </label>

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
            Sign in
        </button>

    </form>


    {{-- Register --}}
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
            Don't have an account?

            <a
                href="{{ route('customer.register') }}"
                class="
                    font-semibold
                    text-gray-900

                    hover:underline

                    dark:text-white
                "
            >
                Create an account
            </a>
        </p>

    </div>

@endsection