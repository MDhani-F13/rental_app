@props([
    'status',
])

@php
    $classes = match ($status) {
        'Pending' =>
            'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',

        'Rented' =>
            'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',

        'Returned' =>
            'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',

        'Late' =>
            'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',

        'Cancelled' =>
            'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',

        default =>
            'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
    };
@endphp

<span
    {{ $attributes->class([
        'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold',
        $classes,
    ]) }}
>
    {{ $status }}
</span>