
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Akreditasi Penjaminan Mutu (APM)
    </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
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
                <table class="table-auto">
                    <tr>
                        <td><button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Data</button></td>
                        <td> <input wire:model="search" type="text" class="shadow appearance-none border rounded py-2 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " placeholder="search penilaian..." ></td>
                        <td> <select wire:model="paginate" name="" id="" class="shadow border rounded py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " >
                                <option value="300">All</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>                  
                            </select>
                        </td>
                        <td class="px-4 py-2 w-96">
                            <table class="table w-full" >
                                <tr>
                                    <td style="text-align: right">
                                        <?php 
                                            $progress =$count/954*100;
                                            echo ceil($progress).'%';
                                        ?>
                                    </td>
                                   
                                </tr>
                            </table>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-pink-200">
                                    <div style="width:<?php echo $progress.'%'?>" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-pink-500"></div>
                            </div>
                        </td>
                    </tr>
                </table>
                
               
               
                @if($isApm)
                    @include('livewire.create-dashboard')
                @endif
               
               
                
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">Area</th>
                            <th class="w-10">Area RB</th>
                            <th class="px-4 py-2 w-60">Penilaian</th>
                            <th class="px-4 py-2 w-60">A</th>
                            <th class="px-4 py-2 w-60">B</th>
                            <th class="px-4 py-2 w-20">C</th>
                            <th class="w-10">Nilai</th>
                            <th class="px-4 py-2 w-20">Kriteria</th>
                            <th class="w-10">Bobot</th>
                            <th class="w-10">Skor</th>
                            <!-- <th class="px-4 py-2 w-20">Panduan Eviden</th>
                            <th class="px-4 py-2 w-20">Catatan Eviden</th> -->
                            <th class="px-4 py-2 w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($apms as $row)
                            <tr>
                                <td class="border px-4 py-2">{{ $row->area_apm->nama_area }}</td>
                                <td class="border px-4 py-2">{{ $row->area_rb }}</td>
                                <td class="border px-4 py-2">{{ $row->penilaian }}</td>
                                <td class="border px-4 py-2">{{ $row->a }}</td>
                                <td class="border px-4 py-2">{{ $row->b }}</td>
                                <td class="border px-4 py-2">{{ $row->c }}</td>
                                <td class="border px-4 py-2" style="text-transform: uppercase;">{{ $row->nilai }}</td>
                                <td class="border px-4 py-2">{{ $row->kriteria_apm->nama_kriteria }}</td>
                                <td class="border px-4 py-2">{{ $row->bobot }}</td>
                                <td class="border px-4 py-2">{{ $row->skor }}</td>
                                <!-- <td class="border px-4 py-2">{{ $row->panduan_eviden }}</td>
                                <td class="border px-4 py-2">{{ $row->catatan_eviden }}</td> -->
                                <td class="border px-4 py-2">
                                <center>
                                <!-- <button wire:click="upload({{ $row->id_apm }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Detail</button><br> -->
                                <a href="{{ Route('file-upload', $row->id_apm) }}"><button  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Eviden</button></a><br>
                                    <button wire:click="edit({{ $row->id_apm }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Edit</button> <br>
                                    <button wire:click="delete({{ $row->id_apm }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button></center>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="border px-4 py-2 text-center" colspan="11">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                {{ $apms->links()}}
            </div>
        </div>
    </div>
</div>

               
 


