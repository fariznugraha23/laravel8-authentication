<div>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Aplikasi APM
    </h2>
</x-slot>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Data</button>
                
                @if($isApm)
                    @include('livewire.create-dashboard')
                @endif

                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Area</th>
                            <th class="px-4 py-2">Area RB</th>
                            <th class="px-4 py-2">Penilaian</th>
                            <th class="px-4 py-2 w-20">A</th>
                            <th class="px-4 py-2 w-20">B</th>
                            <th class="px-4 py-2 w-20">C</th>
                            <th class="px-4 py-2">Nilai</th>
                            <th class="px-4 py-2">Kriteria</th>
                            <th class="px-4 py-2">Bobot</th>
                            <th class="px-4 py-2">Skor</th>
                            <th class="px-4 py-2">Panduan Eviden</th>
                            <th class="px-4 py-2">Catatan Eviden</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($apm as $row)
                            <tr>
                                <td class="border px-4 py-2">{{ $row->id_area }}</td>
                                <td class="border px-4 py-2">{{ $row->area_rb }}</td>
                                <td class="border px-4 py-2">{{ $row->penilaian }}</td>
                                <td class="border px-4 py-2">{!! $row->a !!}</td>
                                <td class="border px-4 py-2">{!! $row->b !!}</td>
                                <td class="border px-4 py-2">{!! $row->c !!}</td>
                                <td class="border px-4 py-2">{{ $row->nilai }}</td>
                                <td class="border px-4 py-2">{{ $row->id_kriteria }}</td>
                                <td class="border px-4 py-2">{{ $row->bobot }}</td>
                                <td class="border px-4 py-2">{{ $row->skor }}</td>
                                <td class="border px-4 py-2">{{ $row->panduan_eviden }}</td>
                                <td class="border px-4 py-2">{{ $row->catatan_eviden }}</td>
                                <td class="border px-4 py-2">
                                    <button wire:click="edit({{ $row->id_apm }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button wire:click="delete({{ $row->id_apm }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="border px-4 py-2 text-center" colspan="13">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
