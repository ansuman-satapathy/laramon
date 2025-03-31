<a href="{{ $url ?? '#' }}" class="block">
    <div class="flex flex-col justify-between h-36 p-4 bg-white dark:bg-zinc-900 shadow-xl rounded-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full {{ $bgColor }} text-white">
                @php
                    $iconComponent = "heroicon-c-{$icon}";
                @endphp

                <x-dynamic-component :component="$iconComponent" class="h-6 w-6 dark:text-slate-700 text-white" />
            </div>

            <div class="ml-4">
                <flux:heading>{{ $title }}</flux:heading>
                <flux:text class="mt-2 text-lg font-bold">{{ $value }}</flux:text>

                @if (!empty($subtitle))
                    <flux:text class="text-sm text-gray-500 dark:text-gray-400">{{ $subtitle }}</flux:text>
                @endif
            </div>
        </div>

        @if (!empty($trend))
            <div class="mt-2 flex items-center text-sm">
                @if ($trend > 0)
                    <x-heroicon-o-arrow-up class="h-4 w-4 text-green-500" />
                    <span class="text-green-500">+{{ $trend }}%</span>
                @elseif ($trend < 0)
                    <x-heroicon-o-arrow-down class="h-4 w-4 text-red-500" />
                    <span class="text-red-500">{{ $trend }}%</span>
                @else
                    <span class="text-gray-400">No Change</span>
                @endif
            </div>
        @endif
    </div>
</a>
