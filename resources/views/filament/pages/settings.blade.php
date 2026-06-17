<x-filament-panels::page>
    <div class="space-y-6">
        <form wire:submit.prevent="save">
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-cog-6-tooth" class="h-5 w-5 text-gray-500 dark:text-gray-400" />
                        <span>Pengaturan Umum</span>
                    </div>
                </x-slot>
                <x-slot name="description">Konfigurasi data instansi dan periode magang.</x-slot>

                <div class="mt-4 grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Instansi</label>
                        <input type="text" wire:model="nama_instansi"
                            class="w-full rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/10 transition shadow-sm">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tanggal Mulai Magang</label>
                            <input type="date" wire:model="tanggal_mulai"
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/10 transition shadow-sm dark:[color-scheme:dark]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tanggal Selesai Magang</label>
                            <input type="date" wire:model="tanggal_selesai"
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/10 transition shadow-sm dark:[color-scheme:dark]">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end border-t border-gray-100 dark:border-gray-800 pt-4">
                    <x-filament::button type="submit" icon="heroicon-o-check">
                        Simpan Perubahan
                    </x-filament::button>
                </div>
            </x-filament::section>
        </form>

        <x-filament::section icon="heroicon-o-light-bulb">
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-light-bulb" class="h-5 w-5 text-amber-500" />
                    <span>Petunjuk</span>
                </div>
            </x-slot>
            <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                <div class="flex gap-3 items-start">
                    <span class="shrink-0 rounded-md bg-gray-50 dark:bg-gray-800 px-2 py-0.5 text-xs font-semibold text-gray-600 dark:text-gray-300 border border-gray-100 dark:border-gray-700">Nama Instansi</span>
                    <span>— dicetak pada kop laporan PDF.</span>
                </div>
                <div class="flex gap-3 items-start">
                    <span class="shrink-0 rounded-md bg-gray-50 dark:bg-gray-800 px-2 py-0.5 text-xs font-semibold text-gray-600 dark:text-gray-300 border border-gray-100 dark:border-gray-700">Periode Magang</span>
                    <span>— menentukan kalkulasi hari ke- dan progress bar dashboard.</span>
                </div>
                <div class="flex gap-3 items-start">
                    <span class="shrink-0 rounded-md bg-gray-50 dark:bg-gray-800 px-2 py-0.5 text-xs font-semibold text-gray-600 dark:text-gray-300 border border-gray-100 dark:border-gray-700">Simpan</span>
                    <span>— pastikan tanggal sudah benar sebelum menyimpan.</span>
                </div>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>