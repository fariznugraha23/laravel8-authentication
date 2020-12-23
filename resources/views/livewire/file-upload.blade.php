<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Kriteria APM
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <input type="hidden" wire:model="postId">
        <input type="hidden" wire:model="id_apm" value="{{$postId}}">
        <div class="form-group">
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
    </div>
    </div>
</div>
