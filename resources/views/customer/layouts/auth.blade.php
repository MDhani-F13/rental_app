<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @fluxAppearance

    <title>@yield('title', 'Customer')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="
        min-h-full
        bg-gray-100
        text-gray-900
        transition-colors

        dark:bg-gray-950
        dark:text-gray-100
    "
>

    <main
        class="
            flex min-h-screen
            items-center justify-center
            px-4 py-8

            sm:py-12
        "
    >

        <div class="w-full max-w-md">

            {{-- Application Header --}}
            <div class="mb-6 text-center sm:mb-8">

                <a
                    href="{{ route('customer.store') }}"
                    class="
                        inline-block
                        text-2xl font-bold
                        tracking-tight
                        text-gray-900
                        transition-colors

                        hover:text-gray-600

                        sm:text-3xl

                        dark:text-white
                        dark:hover:text-gray-300
                    "
                >
                    Rental System
                </a>

                <p
                    class="
                        mt-2 text-sm
                        text-gray-600
                        dark:text-gray-400
                    "
                >
                    Customer Portal
                </p>

            </div>


            {{-- Authentication Card --}}
            <div
                class="
                    rounded-xl
                    bg-white
                    p-5
                    shadow-sm
                    ring-1 ring-gray-200

                    sm:p-8

                    dark:bg-gray-900
                    dark:ring-gray-800
                "
            >

                @yield('content')

            </div>


            {{-- Back to Store --}}
            <div class="mt-6 text-center">

                <a
                    href="{{ route('customer.store') }}"
                    class="
                        text-sm font-medium
                        text-gray-600
                        transition-colors

                        hover:text-gray-900

                        dark:text-gray-400
                        dark:hover:text-white
                    "
                >
                    &larr; Back to equipment
                </a>

            </div>


            {{-- Footer --}}
            <p
                class="
                    mt-4 text-center
                    text-xs text-gray-500
                    dark:text-gray-500
                "
            >
                &copy; {{ date('Y') }} Rental System. All rights reserved.
            </p>

        </div>

    </main>
    @fluxScripts
</body>
</html>