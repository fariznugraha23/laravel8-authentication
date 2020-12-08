<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KriteriaApm;

class KriteriaApms extends Component
{
    public $kriteria, $nama_kriteria, $id_kriteria;
    public $isKriteria = 0;
    public function render()
    {
        $this->kriteria = KriteriaApm::orderBy('id_kriteria', 'ASC')->get();
        return view('livewire.kriteria-apms');
    }
    public function create()
    {
        $this->resetFields();
        $this->openKriteria();
    }
    public function openKriteria()
    {
        $this->isKriteria = true;
    }
    public function closeKriteria()
    {
        $this->isKriteria = false;
    }
    public function resetFields()
    {
        $this->nama_kriteria = '';
       
    }
    public function store()
    {
        $this->validate([
            'nama_kriteria' => 'required|string'
        ]);
        KriteriaApm::updateOrCreate(['id_kriteria' => $this->id_kriteria], [
            'nama_kriteria' => $this->nama_kriteria,
        ]);
        session()->flash('message', $this->id_kriteria ? $this->nama_kriteria . ' Diperbaharui': $this->nama_kriteria . ' Ditambahkan');
        $this->closeKriteria(); 
        $this->resetFields(); 
    }
    public function edit($id_kriteria)
    {
        $kriteria = KriteriaApm::find($id_kriteria); 
       
        $this->id_kriteria = $id_kriteria;
        $this->nama_kriteria = $kriteria->nama_kriteria;

        $this->openKriteria();
    }
    public function delete($id_kriteria)
    {
        $kriteria = KriteriaApm::find($id_kriteria);
        $kriteria->delete(); 
        session()->flash('message', $kriteria->nama_kriteria . ' Dihapus');
    }
}
