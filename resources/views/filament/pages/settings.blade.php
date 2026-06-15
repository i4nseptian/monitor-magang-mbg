<x-filament-panels::page>
    <div class="space-y-6">
        <form wire:submit.prevent="save">
            <x-filament::section>
                <x-slot name="heading">⚙️ Pengaturan Umum</x-slot>
                <x-slot name="description">Konfigurasi data dasar instansi dan periode magang mahasiswa.</x-slot>

                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Instansi</label>
                        <input type="text" wire:model="nama_instansi"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai Magang</label>
                            <input type="date" wire:model="tanggal_mulai"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Selesai Magang</label>
                            <input type="date" wire:model="tanggal_selesai"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-filament::button type="submit" color="primary">
                        Simpan Perubahan
                    </x-filament::button>
                </div>
            </x-filament::section>
        </form>

        {{-- Info Box / Guidelines --}}
        <x-filament::section>
            <x-slot name="heading">ℹ️ Petunjuk Konfigurasi</x-slot>
            <div class="text-sm text-gray-600 dark:text-gray-400 space-y-2 leading-relaxed">
                <p>1. <strong>Nama Instansi</strong> akan dicetak pada seluruh kop dan tanda tangan Laporan PDF (Harian, Mingguan, Bulanan, Akhir).</p>
                <p>2. <strong>Tanggal Mulai & Selesai</strong> menentukan kalkulasi "Hari Ke-" otomatis pada input logbook mahasiswa magang serta menentukan progress bar pada widget Dashboard.</p>
                <p>3. Pastikan format tanggal sudah benar sebelum menekan tombol simpan.</p>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
