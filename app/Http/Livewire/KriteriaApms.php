<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KriteriaApm;
use Livewire\WithPagination;

class KriteriaApms extends Component
{
    use WithPagination;
    public $kriteria, $nama_kriteria, $id_kriteria;
    public $isKriteria = 0;
    public $paginate=7;
    public $search;
    protected $queryString = ['search'];
    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        // $this->kriteria = KriteriaApm::orderBy('id_kriteria', 'ASC')->get();
        // return view('livewire.kriteria-apms');
        // return view('livewire.kriteria-apms',['kriterias' => KriteriaApm::orderBy('id_kriteria', 'ASC')->paginate(7)]);
        return view('livewire.kriteria-apms',[
            'kriterias' => $this->search === null ?
            KriteriaApm::orderBy('id_kriteria', 'ASC')->paginate($this->paginate) :
            KriteriaApm::orderBy('id_kriteria', 'ASC')->where('nama_kriteria','like','%'.$this->search.'%')->paginate($this->paginate)]);
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
