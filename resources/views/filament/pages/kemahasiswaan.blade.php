<x-filament::page>
    <h2 class="text-xl font-bold mb-4">Daftar Mahasiswa Perwalian</h2>

    <table class="w-full border-collapse text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nim</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">KRS</th>
                <th class="border px-4 py-2">KHS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($this->mahasiswa as $index => $mahasiswa)
                <tr>
                    {{-- <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td> --}}
                    <td class="border px-4 py-2">{{ $mahasiswa->nim }}</td>
                    <td class="border px-4 py-2">{{ $mahasiswa->user->name }}</td>
                    <td class="border px-4 py-2 text-center">{{ $mahasiswa->sks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada data Mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-filament::page>
