@props([
    'label',
    'value',
    'icon' => null,
    'trend' => null,
    'color' => 'primary',
])

@php
    $colorMap = [
        'primary' => 'bg-primary-50 text-primary-700 dark:bg-primary-950/50 dark:text-primary-300 border-primary-200/60 dark:border-primary-800',
        'success' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300 border-emerald-200/60 dark:border-emerald-800',
        'warning' => 'bg-amber-50 text-amber-700 dark:bg-amber-950/50 dark:text-amber-300 border-amber-200/60 dark:border-amber-800',
        'danger' => 'bg-red-50 text-red-700 dark:bg-red-950/50 dark:text-red-300 border-red-200/60 dark:border-red-800',
        'info' => 'bg-sky-50 text-sky-700 dark:bg-sky-950/50 dark:text-sky-300 border-sky-200/60 dark:border-sky-800',
    ];
    $cardColor = $colorMap[$color] ?? $colorMap['primary'];
@endphp

<div {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-xl border bg-white dark:bg-gray-900 p-5 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 ' . $cardColor]) }}>
    <div class="absolute -right-4 -top-4 h-20 w-20 rounded-full bg-current opacity-[0.07]"></div>
    <div class="absolute -bottom-6 -left-6 h-16 w-16 rounded-full bg-current opacity-[0.04]"></div>

    <div class="relative">
        @if($icon)
            <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-current/10 text-current">
                {!! $icon !!}
            </div>
        @endif
        <p class="text-2xl font-bold tracking-tight tabular-nums text-gray-900 dark:text-white">{{ $value }}</p>
        <p class="mt-1 text-xs font-semibold text-gray-500 dark:text-gray-400">{{ $label }}</p>
        @if($trend)
            <p class="mt-2 flex items-center gap-1 text-[11px] font-medium text-gray-400 dark:text-gray-500">
                {{ $trend }}
            </p>
        @endif
    </div>
</div>
