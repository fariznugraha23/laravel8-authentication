<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Area APM
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Area</button>
            
    
            <input wire:model="search" type="text" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " placeholder="search..." >

            <select wire:model="paginate" name="" id="" class="shadow border rounded py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " >
                <option value="100">All</option>
                <option value="5">5</option>
                <option value="7">7</option>
                <option value="10">10</option>                  

            </select>
            @if($isArea)
                @include('livewire.create')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2" width="10%">Nomor</th>
                        <th class="px-4 py-2" width="55%">Nama Area</th>
                        <th class="px-4 py-2" width="35%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($areas as $row)
                        <tr>
                        <td class="border px-4 py-2"> <center>{{ $row->id_area }}</center></td>
                            <td class="border px-4 py-2">{{ $row->nama_area }}</td>
                            <td class="border px-4 py-2">
                                <center>
                                    <button wire:click="edit({{ $row->id_area }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button wire:click="delete({{ $row->id_area }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                                </center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="5">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            {{ $areas->links()}}
        </div>
    </div>
</div>