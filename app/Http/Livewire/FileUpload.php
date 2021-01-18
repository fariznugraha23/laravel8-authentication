<?php

namespace App\Http\Livewire;
use App\Models\Apm;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
class FileUpload extends Component
{
    use WithFileUploads;
    public $file, $title, $postId, $id_apm, $nilai;
    public $isNilai = 0;
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount($id_apm){
        $apm = Apm::find($id_apm);
        if($apm){
            $this->postId=$apm->id_apm;
        }
    }
    public function submit()
    {
        $validatedData = $this->validate([
            'id_apm' => 'required',
            'title' => 'required',
            'file' => 'required',
        ]);
        $validatedData['name'] = $this->file->store('files', 'public');
        File::create($validatedData);
        session()->flash('message', 'File successfully Uploaded.');
    } 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.file-upload', [
            'files' => File::where('id_apm', $this->postId)->get(),
            'apm' => Apm::where('id_apm', $this->postId)->get(),
        ]);
    }
    // public function download($name)
    // {
    //     return Storage::disk('local')->download($name);
    // } 
    public function delete($id_file)
    {
        $data = File::find($id_file);
        $data->delete(); 
        session()->flash('message', 'Data Dihapus');
    }
    public function create()
    {
        $this->resetFields();
        $this->openNilai();
    }
    public function closeNilai()
    {
        $this->isNilai = false;
    }
    public function openNilai()
    {
        $this->isNilai = true;
    }
    public function resetFields()
    {
        $this->nilai = '';  
    }
    public function store()
    {
        $this->validate([
            'nilai' => 'required|string'
        ]);
        Apm::updateOrCreate(['id_apm' => $this->id_apm], [
            'nilai' => $this->nilai,
        ]);
        session()->flash('message', $this->id_apm ?  'Nilai Diperbaharui':  'Nilai Ditambahkan');
        $this->closeNilai(); 
        $this->resetFields();
    }
    public function edit($postId)
    {
        $apm = Apm::find($postId);
        $this->id_apm = $postId;
        $this->nilai = $apm->nilai;
        $this->openNilai();
    }

}
