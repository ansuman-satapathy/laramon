@php
    $color = match (true) {
        $status == 200 => 'bg-accent-content text-white dark:text-slate-500',
        $status >= 400 && $status < 500 => 'bg-yellow-300 text-white dark:text-gray-900',
        $status >= 500 => 'bg-red-400 text-white',
        default => 'bg-gray-500 text-white dark:text-slate-500',
    };
@endphp

<span class="px-2 py-1 rounded text-white {{ $color }}">
    {{ $status }}
</span>
