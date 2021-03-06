<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Eviden APM
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            
            <a href="{{ route('dashboard') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded "> < Back</a>
            
            @if(auth()->user()->level==3)
                <button wire:click="edit({{$postId}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"> Nilai</button>
                    @forelse($apm as $skors)
                        <button style="cursor: default;" class="bg-yellow-300 text-white font-bold py-2 px-4 rounded"> @if(($skors->nilai)==null) 0 @else  {{$skors->nilai}} @endif </button>
                        <button style="cursor: default;" class="bg-yellow-300 text-white font-bold py-2 px-4 rounded"> @if(($skors->skor)==null) 0 @else  {{$skors->skor}} @endif </button>
                    @empty
                        <button style="cursor: default;" class="bg-yellow-300 text-white font-bold py-2 px-4 rounded"> 0  </button>
                        <button style="cursor: default;" class="bg-yellow-300 text-white font-bold py-2 px-4 rounded"> 0   </button>
                    @endforelse
                        @if($isNilai)
                            @include('livewire.create-nilai')
                        @endif
                    @if (session()->has('message'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                            <div class="flex">
                                <div class="alert alert-success">
                                    <p class="text-sm">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

            @else

                @forelse($apm as $skors)
                    <button style="cursor: default;" class="bg-yellow-300 text-white font-bold py-2 px-4 rounded"> {{$skors->nilai}}  </button>
                    <button style="cursor: default;" class="bg-yellow-300 text-white font-bold py-2 px-4 rounded"> @if(($skors->skor)==null) 0 @else  {{$skors->skor}} @endif </button>
                @empty
                    <button style="cursor: default;" class="bg-yellow-300 text-white font-bold py-2 px-4 rounded"> -  </button>
                    <button style="cursor: default;" class="bg-yellow-300 text-white font-bold py-2 px-4 rounded"> 0   </button>
                @endforelse
                @if(session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                        
                            <div class="alert alert-success">
                            {{ session('message') }}
                            </div>
                        
                    </div>
                        
                    @endif
            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                
                <input type="hidden" wire:model="postId">
                <input type="hidden" wire:model="id_apm" value="{{$postId}}">
                <div class="form-group">
                <br>
                    <label for="exampleInputName">Title:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleInputName" placeholder="" wire:model="title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputName">File:</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleInputName" wire:model="file">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Save</button>
            </form>
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2" width="40%">Title</th>
                        <th class="px-4 py-2" width="30%">Download</th>
                        @if(auth()->user()->level!=3)
                        <th class="px-4 py-2" width="30%">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @forelse($files as $user)
                   <tr>
                        <td class="border px-4 py-2"><center>{{ $user->title }}</center></td>
                        <td class="border px-4 py-2"><center><a  class="bg-green-500 hover:bg-greenS-700 text-white font-bold py-2 px-4 rounded my-3" href="{{ Storage::url('public/'.$user->name) }}" download>Download</a> </center></td>
                        @if(auth()->user()->level<3)
                        <td class="border px-4 py-2"><center>  
                        <!-- <button wire:click="edit({{ $user->id_file }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Edit</button> -->
                        <button wire:click="delete({{ $user->id_file }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                        </center> </td>
                        @endif
                        
                    </tr>
                    @empty
                    <tr>
                        @if(auth()->user()->level<3)
                        <td class="border px-4 py-2 text-center" colspan="3">Tidak ada data</td>
                        @else
                        <td class="border px-4 py-2 text-center" colspan="2">Tidak ada data</td>
                        @endif 
                    </tr>
                    @endforelse
                   
                </tbody>
            </table>
        </div>
    </div>
</div>



