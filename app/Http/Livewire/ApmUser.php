<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
class ApmUser extends Component
{
    use WithPagination;
    public $idz, $user, $name, $username, $email, $level,$password;
    public $isUser = 0;
    public $paginate=7;
    public $search;
    protected $queryString = ['search'];
    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        // $this->user = UserApm::orderBy('id_user', 'ASC')->paginate(5);
        // return view('livewire.user-apms',['users' => UserApm::orderBy('id_user', 'ASC')->paginate($this->paginate)]);
        return view('livewire.apm-user',[
            'users' => $this->search === null ?
            User::orderBy('id', 'ASC')->paginate($this->paginate) :
            User::orderBy('id', 'ASC')->where('name','like','%'.$this->search.'%')->paginate($this->paginate)]);
    }
    public function create()
    {
        //KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD
        $this->resetFields();
        //DAN MEMBUKA AREA
        $this->openUser();
    }

    //FUNGSI INI UNTUK MENUTUP User DIMANA VARIABLE ISAREA KITA SET JADI FALSE
    public function closeUser()
    {
        $this->isUser = false;
    }

    //FUNGSI INI DIGUNAKAN UNTUK MEMBUKA AREA
    public function openUser()
    {
        $this->isUser = true;
    }

    //FUNGSI INI UNTUK ME-RESET FIELD/KOLOM, SESUAIKAN FIELD APA SAJA YANG KAMU MILIKI
    public function resetFields()
    {
        $this->name = '';
       
    }

    //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
        //MEMBUAT VALIDASI
        $this->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string'
        ]);
        $pass = $this->password;
        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        User::updateOrCreate(['id' => $this->idz], [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $pass,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('message', $this->id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeUser(); //TUTUP User
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER
    public function edit($id)
    {
        $user = User::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->idz = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->password = $user->password;

        $this->openUser(); //LALU BUKA User
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $user = User::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $user->delete(); //LALU HAPUS DATA
        session()->flash('message', $user->name . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
}
