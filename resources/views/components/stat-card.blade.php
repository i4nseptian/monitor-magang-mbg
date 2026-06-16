@props([
    'label',
    'value',
    'icon' => null,
    'trend' => null,
])

<div {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-xl border border-gray-200/80 dark:border-gray-700 bg-white dark:bg-gray-900 p-5 transition duration-200 hover:border-primary-200 dark:hover:border-primary-800 hover:shadow-sm']) }}>
    <div class="absolute -right-3 -top-3 h-16 w-16 rounded-full bg-primary-50 dark:bg-primary-950/40 opacity-60 transition group-hover:scale-110"></div>

    <div class="relative flex items-start justify-between gap-3">
        <div class="min-w-0 flex-1">
            @if($icon)
                <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-primary-50 text-primary-700 dark:bg-primary-950/50 dark:text-primary-300">
                    {!! $icon !!}
                </div>
            @endif
            <p class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $value }}</p>
            <p class="mt-1 text-xs font-medium text-gray-500 dark:text-gray-400">{{ $label }}</p>
            @if($trend)
                <p class="mt-2 text-[11px] text-gray-400 dark:text-gray-500">{{ $trend }}</p>
            @endif
        </div>
    </div>
</div>
