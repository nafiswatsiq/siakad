<x-filament-panels::page>
    {{-- <table>
        <tr>
            <td>nama</td>
            <td>email</td>
        </tr>
        @foreach ($user as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
            </tr>
        @endforeach
    </table> --}}
    {{-- <p>{{ $data->name }}</p>
    <p>{{ $data->email }}</p> --}}


    {{ $this->table }}
</x-filament-panels::page>
