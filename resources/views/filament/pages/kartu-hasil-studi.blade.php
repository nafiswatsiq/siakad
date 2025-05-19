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
            @foreach($this->matkuls as $index => $matkul)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $matkul->kode_matkul }}</td>
                    <td class="border px-4 py-2">{{ $matkul->nama }}</td>
                    <td class="border px-4 py-2 text-center">{{ $matkul->sks }}</td>
                </tr>
            {{-- @empty --}}
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada data mata kuliah.</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <table class="w-full border-collapse text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Kode Mata Kuliah</th>
                <th class="border px-4 py-2">Nama Mata Kuliah</th>
                <th class="border px-4 py-2">SKS</th>
            </tr>
        </thead>
       <tbody>
            @forelse ($this->mahasiswa as $index => $mahasiswa)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->user->name }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->nim }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->kelas->nama ?? '-' }}</td> <!-- contoh nama kelas -->
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada data mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>

    </table> --}}
</x-filament::page>
