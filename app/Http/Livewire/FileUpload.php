<?php

namespace App\Http\Livewire;
use App\Models\Apm;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;

class FileUpload extends Component
{
    use WithFileUploads;
    public $file, $title;
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submit()
    {
        $validatedData = $this->validate([
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
    public function render($id_apm)
    {
        $apm = Apm::find($id_apm);
        $this->id_apm = $id_apm;
        $this->id_area = $apm->id_area;
        $this->area_rb = $apm->area_rb;
        $this->penilaian = $apm->penilaian;
        $this->a = $apm->a;
        $this->b = $apm->b;
        $this->c = $apm->c;
        $this->nilai = $apm->nilai;
        $this->id_kriteria = $apm->id_kriteria;
        $this->bobot = $apm->bobot;
        $this->skor = $apm->skor;
        $this->panduan_eviden = $apm->panduan_eviden;
        $this->catatan_eviden = $apm->catatan_eviden;
        return view('livewire.file-upload');
    }
}
