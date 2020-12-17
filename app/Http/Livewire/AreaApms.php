<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AreaApm;
class AreaApms extends Component
{
    use WithPagination;
    public $area, $nama_area, $id_area;
    public $isArea = 0;
    public $paginate=7;
    public $search;
    protected $queryString = ['search'];
    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        // $this->area = AreaApm::orderBy('id_area', 'ASC')->paginate(5);
        // return view('livewire.area-apms',['areas' => AreaApm::orderBy('id_area', 'ASC')->paginate($this->paginate)]);
        return view('livewire.area-apms',[
            'areas' => $this->search === null ?
            AreaApm::orderBy('id_area', 'ASC')->paginate($this->paginate) :
            AreaApm::orderBy('id_area', 'ASC')->where('nama_area','like','%'.$this->search.'%')->paginate($this->paginate)]);
    }
    public function create()
    {
        //KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD
        $this->resetFields();
        //DAN MEMBUKA AREA
        $this->openArea();
    }

    //FUNGSI INI UNTUK MENUTUP Area DIMANA VARIABLE ISAREA KITA SET JADI FALSE
    public function closeArea()
    {
        $this->isArea = false;
    }

    //FUNGSI INI DIGUNAKAN UNTUK MEMBUKA AREA
    public function openArea()
    {
        $this->isArea = true;
    }

    //FUNGSI INI UNTUK ME-RESET FIELD/KOLOM, SESUAIKAN FIELD APA SAJA YANG KAMU MILIKI
    public function resetFields()
    {
        $this->nama_area = '';
       
    }

    //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
        //MEMBUAT VALIDASI
        $this->validate([
            'nama_area' => 'required|string'
        ]);

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        AreaApm::updateOrCreate(['id_area' => $this->id_area], [
            'nama_area' => $this->nama_area,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('message', $this->id_area ? $this->nama_area . ' Diperbaharui': $this->nama_area . ' Ditambahkan');
        $this->closeArea(); //TUTUP Area
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER
    public function edit($id_area)
    {
        $area = AreaApm::find($id_area); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_area = $id_area;
        $this->nama_area = $area->nama_area;

        $this->openArea(); //LALU BUKA Area
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id_area)
    {
        $area = AreaApm::find($id_area); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $area->delete(); //LALU HAPUS DATA
        session()->flash('message', $area->nama_area . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
}
