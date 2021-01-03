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
    public $file, $title, $postId, $id_apm;
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

}
