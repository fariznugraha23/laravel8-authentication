<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Apm;
use App\Models\AreaApm;
use App\Models\KriteriaApm;
use DB;
class Apms extends Component
{
    public $apm, $id_apm, $kriteria,$area, $id_area, $area_rb, $penilaian, $a, $b, $c, $nilai, $id_kriteria, $bobot, $skor, $panduan_eviden, $catatan_eviden;
    public $isApm = 0;
    use WithPagination;
    public $paginate=300;
    public $search;
    protected $queryString = ['search'];
    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        // $this->apm = Apm::orderBy('id_apm', 'ASC')->get();
        // return view('dashboard',['apms'=> Apm::orderBy('id_apm', 'ASC')->paginate(10)]);
        $count = DB::table('apms')->sum('skor');
        $skor = DB::table('apms')->sum('bobot');
        return view('dashboard',[
            'apms' => $this->search === null ?
            Apm::orderBy('id_apm', 'ASC')->paginate($this->paginate) :
            Apm::orderBy('id_apm', 'ASC')->where('penilaian','like','%'.$this->search.'%')->paginate($this->paginate),
            'count'=> $count,
            'skor'=> $skor,
            ]);
    
    }
    public function create()
    {
        $this->resetFields();
        $this->openApm();
        $this->area = AreaApm::orderBy('id_area', 'ASC')->get();
        $this->kriteria = KriteriaApm::orderBy('id_kriteria', 'ASC')->get();
    }
    public function openApm()
    {
        $this->isApm = true;
    }
    public function closeApm()
    {
        $this->isApm = false;
    }
    public function resetFields()
    {
        $this->id_area = '';
        $this->area_rb = '';
        $this->penilaian = '';
        $this->a = '';
        $this->b = '';
        $this->c = '';
        $this->nilai = '';
        $this->id_kriteria = '';
        $this->bobot = '';
        $this->skor = '';
        $this->panduan_eviden = '';
        $this->catatan_eviden = '';
       
    }
    public function store()
    {
        $this->validate([
            'id_area' => 'required|integer',
            'area_rb' => 'required|integer',
            'penilaian' => 'required|string',
            'a' => 'required|string',
            'b' => 'required|string',
            'c' => 'required|string',
            'nilai' => 'string',
            'id_kriteria' => 'required|integer',
            'bobot' => 'required|integer',
            'skor' => 'string',
            'panduan_eviden' => 'required',
            'catatan_eviden' => 'required'
        ]);
        
        Apm::updateOrCreate(['id_apm' => $this->id_apm], [
            'id_area' => $this->id_area,
            'area_rb' => $this->area_rb,
            'penilaian' => $this->penilaian,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'nilai' => $this->nilai,
            'id_kriteria' => $this->id_kriteria,
            'bobot' => $this->bobot,
            'skor' => $this->skor,
            'panduan_eviden' => $this->panduan_eviden,
            'catatan_eviden' => $this->catatan_eviden,
        ]);
        session()->flash('message', $this->id ? 'Data Diperbaharui': 'Data Ditambahkan');
        $this->closeApm(); 
        $this->resetFields(); 
    }
    public function edit($id_apm)
    {
        $apm = Apm::find($id_apm); 
        $this->area = AreaApm::orderBy('id_area', 'ASC')->get();
        $this->kriteria = KriteriaApm::orderBy('id_kriteria', 'ASC')->get();
       
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

        $this->openApm();
    }
    // public function upload($id_apm)
    // {
    //     $apm = Apm::find($id_apm); 
    //     $this->area = AreaApm::orderBy('id_area', 'ASC')->get();
    //     $this->kriteria = KriteriaApm::orderBy('id_kriteria', 'ASC')->get();

    //     $this->id_apm = $id_apm;
    //     $this->id_area = $apm->id_area;
    //     $this->area_rb = $apm->area_rb;
    //     $this->penilaian = $apm->penilaian;
    //     $this->a = $apm->a;
    //     $this->b = $apm->b;
    //     $this->c = $apm->c;
    //     $this->nilai = $apm->nilai;
    //     $this->id_kriteria = $apm->id_kriteria;
    //     $this->bobot = $apm->bobot;
    //     $this->skor = $apm->skor;
    //     $this->panduan_eviden = $apm->panduan_eviden;
    //     $this->catatan_eviden = $apm->catatan_eviden;

    //     $this->openApm();
    // }
    public function delete($id_apm)
    {
        $apm = Apm::find($id_apm);
        $apm->delete(); 
        session()->flash('message', 'Data Dihapus');
    }
}
