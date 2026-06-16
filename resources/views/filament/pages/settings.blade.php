<x-filament-panels::page>
    <div class="space-y-6">
        <form wire:submit.prevent="save">
            <x-filament::section>
                <x-slot name="heading">Pengaturan Umum</x-slot>
                <x-slot name="description">Konfigurasi data instansi dan periode magang.</x-slot>

                <div class="mt-4 grid grid-cols-1 gap-5">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Instansi</label>
                        <input type="text" wire:model="nama_instansi"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai Magang</label>
                            <input type="date" wire:model="tanggal_mulai"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai Magang</label>
                            <input type="date" wire:model="tanggal_selesai"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-filament::button type="submit" icon="heroicon-o-check">
                        Simpan Perubahan
                    </x-filament::button>
                </div>
            </x-filament::section>
        </form>

        <x-filament::section icon="heroicon-o-information-circle">
            <x-slot name="heading">Petunjuk</x-slot>
            <ul class="space-y-2 text-sm leading-relaxed text-gray-600 dark:text-gray-400">
                <li class="flex gap-2"><span class="font-semibold text-gray-800 dark:text-gray-300">Nama Instansi</span> — dicetak pada kop laporan PDF.</li>
                <li class="flex gap-2"><span class="font-semibold text-gray-800 dark:text-gray-300">Periode Magang</span> — menentukan kalkulasi hari ke- dan progress bar dashboard.</li>
                <li class="flex gap-2"><span class="font-semibold text-gray-800 dark:text-gray-300">Simpan</span> — pastikan tanggal sudah benar sebelum menyimpan.</li>
            </ul>
        </x-filament::section>
    </div>
</x-filament-panels::page>
