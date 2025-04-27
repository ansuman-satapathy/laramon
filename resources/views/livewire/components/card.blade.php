<div class="flex flex-col justify-between h-36 p-4 bg-white dark:bg-zinc-900 shadow-xl rounded-lg">
    <div class="flex items-center">
        <div class="p-3 ml-2 mt-2  rounded-full {{ $bgColor }} text-white">
            @php
                $iconComponent = "heroicon-c-{$icon}";
            @endphp

            <x-dynamic-component :component="$iconComponent" class="h-6 w-6 dark:text-slate-700 text-white" />
        </div>

        <div class="ml-4 flex-grow">
            <flux:heading class="mt-4">{{ $title }}</flux:heading>
            <flux:text class="mt-2 text-lg font-bold">{{ $value }}</flux:text>

            @if (!empty($subtitle))
                <flux:text class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $subtitle }}</flux:text>
            @endif
        </div>
    </div>
</div>