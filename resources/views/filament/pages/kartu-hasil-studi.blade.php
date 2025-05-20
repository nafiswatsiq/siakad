<x-filament::page>
    <h2 class="text-xl font-bold mb-4">Kartu Hasil Studi</h2>

    <table class="w-full border-collapse text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Kode Mata Kuliah</th>
                <th class="border px-4 py-2">Nama Mata Kuliah</th>
                <th class="border px-4 py-2">SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($this->matkuls as $index => $matkul)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $matkul->matkul->kode_matkul ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $matkul->matkul->nama ?? '-' }}</td>
                    <td class="border px-4 py-2 text-center">{{ $matkul->matkul->sks ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada data mata kuliah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-filament::page>