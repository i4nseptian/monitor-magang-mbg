@props([
    'label',
    'value',
    'icon' => null,
    'trend' => null,
    'color' => 'primary',
])

@php
    $colorMap = [
        'primary' => [
            'bg' => 'bg-indigo-50/60 dark:bg-indigo-950/30',
            'border' => 'border-indigo-200/50 dark:border-indigo-900/40',
            'text' => 'text-indigo-600 dark:text-indigo-400',
            'hoverGlow' => 'hover:shadow-indigo-500/10 dark:hover:shadow-indigo-500/5',
            'iconBg' => 'bg-indigo-100 dark:bg-indigo-950/50',
        ],
        'success' => [
            'bg' => 'bg-emerald-50/60 dark:bg-emerald-950/30',
            'border' => 'border-emerald-200/50 dark:border-emerald-900/40',
            'text' => 'text-emerald-600 dark:text-emerald-400',
            'hoverGlow' => 'hover:shadow-emerald-500/10 dark:hover:shadow-emerald-500/5',
            'iconBg' => 'bg-emerald-100 dark:bg-emerald-950/50',
        ],
        'warning' => [
            'bg' => 'bg-amber-50/60 dark:bg-amber-950/30',
            'border' => 'border-amber-200/50 dark:border-amber-900/40',
            'text' => 'text-amber-600 dark:text-amber-400',
            'hoverGlow' => 'hover:shadow-amber-500/10 dark:hover:shadow-amber-500/5',
            'iconBg' => 'bg-amber-100 dark:bg-amber-950/50',
        ],
        'danger' => [
            'bg' => 'bg-rose-50/60 dark:bg-rose-950/30',
            'border' => 'border-rose-200/50 dark:border-rose-900/40',
            'text' => 'text-rose-600 dark:text-rose-400',
            'hoverGlow' => 'hover:shadow-rose-500/10 dark:hover:shadow-rose-500/5',
            'iconBg' => 'bg-rose-100 dark:bg-rose-950/50',
        ],
        'info' => [
            'bg' => 'bg-cyan-50/60 dark:bg-cyan-950/30',
            'border' => 'border-cyan-200/50 dark:border-cyan-900/40',
            'text' => 'text-cyan-600 dark:text-cyan-400',
            'hoverGlow' => 'hover:shadow-cyan-500/10 dark:hover:shadow-cyan-500/5',
            'iconBg' => 'bg-cyan-100 dark:bg-cyan-950/50',
        ],
    ];

    $theme = $colorMap[$color] ?? $colorMap['primary'];
@endphp

<div {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-xl border bg-white dark:bg-[#0d121c] p-4 sm:p-5 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 ' . $theme['border'] . ' ' . $theme['hoverGlow']]) }}>
    <div class="flex items-center justify-between mb-3">
        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">{{ $label }}</span>
        @if($icon)
            <div class="flex h-7 w-7 items-center justify-center rounded-lg {{ $theme['iconBg'] }} {{ $theme['text'] }} transition-all duration-200 group-hover:scale-110">
                {!! $icon !!}
            </div>
        @endif
    </div>
    
    <p class="text-xl sm:text-2xl font-bold tracking-tight tabular-nums text-gray-900 dark:text-white">{{ $value }}</p>

    @if($trend)
        <div class="flex items-center gap-1 text-[11px] font-medium text-gray-400 dark:text-gray-500 pt-2 mt-3 border-t border-gray-100 dark:border-gray-800">
            {{ $trend }}
        </div>
    @endif
</div>