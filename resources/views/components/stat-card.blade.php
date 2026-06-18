@props([
    'label',
    'value',
    'icon' => null,
    'trend' => null,
    'trendDirection' => null,
    'trendLabel' => null,
    'color' => 'primary',
])

@php
    $colorMap = [
        'primary' => [
            'iconBg' => 'bg-indigo-50 dark:bg-indigo-950/30',
            'iconColor' => 'text-indigo-600 dark:text-indigo-400',
            'valueText' => 'text-slate-900 dark:text-slate-100',
        ],
        'success' => [
            'iconBg' => 'bg-emerald-50 dark:bg-emerald-950/30',
            'iconColor' => 'text-emerald-600 dark:text-emerald-400',
            'valueText' => 'text-slate-900 dark:text-slate-100',
        ],
        'warning' => [
            'iconBg' => 'bg-amber-50 dark:bg-amber-950/30',
            'iconColor' => 'text-amber-600 dark:text-amber-400',
            'valueText' => 'text-slate-900 dark:text-slate-100',
        ],
        'danger' => [
            'iconBg' => 'bg-rose-50 dark:bg-rose-950/30',
            'iconColor' => 'text-rose-600 dark:text-rose-400',
            'valueText' => 'text-slate-900 dark:text-slate-100',
        ],
        'info' => [
            'iconBg' => 'bg-cyan-50 dark:bg-cyan-950/30',
            'iconColor' => 'text-cyan-600 dark:text-cyan-400',
            'valueText' => 'text-slate-900 dark:text-slate-100',
        ],
    ];

    $theme = $colorMap[$color] ?? $colorMap['primary'];

    $trendColorClass = match ($trendDirection) {
        'up' => 'text-emerald-600 dark:text-emerald-400',
        'down' => 'text-rose-600 dark:text-rose-400',
        default => 'text-slate-400 dark:text-slate-500',
    };
@endphp

<div {{ $attributes->merge(['class' => 'group relative rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-4 shadow-[0_1px_2px_rgb(0_0_0/0.05)] transition-all hover:shadow-[0_4px_12px_-2px_rgb(0_0_0/0.08)]']) }}>

    <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-medium text-slate-400 dark:text-slate-500">{{ $label }}</span>
        @if($icon)
            <div class="flex h-8 w-8 items-center justify-center rounded-lg {{ $theme['iconBg'] }} {{ $theme['iconColor'] }}">
                {!! $icon !!}
            </div>
        @endif
    </div>

    <p class="text-xl font-semibold tabular-nums {{ $theme['valueText'] }}">{{ $value }}</p>

    @if($trend || $trendDirection || $trendLabel)
        <div class="flex items-center gap-1.5 pt-2.5 mt-2.5 border-t border-slate-100 dark:border-slate-800">
            @if($trendDirection === 'up')
                <svg class="h-3 w-3 {{ $trendColorClass }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>
            @elseif($trendDirection === 'down')
                <svg class="h-3 w-3 {{ $trendColorClass }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 3.09M20.25 21v-5.25m0 0h-5.25m5.25 0-2.926 2.926"/></svg>
            @endif
            @if($trendLabel)
                <span class="text-[11px] font-medium {{ $trendColorClass }}">{{ $trendLabel }}</span>
            @endif
            @if($trend)
                <span class="text-[11px] text-slate-400 dark:text-slate-500">{{ $trend }}</span>
            @endif
        </div>
    @endif
</div>
