<?php

namespace App\Http\Livewire;

use App\Models\Liga;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $jumlah = 0;

    protected $listeners = [
        'masukkanKeranjang' => 'updateKeranjang'
    ];

    public function updateKeranjang(){
        if (Auth::user()) {
            // kita membuat variable untuk pesanan yang identik dari user ini
            $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if ($pesanan) {
                $this->jumlah = PesananDetail::where('pesanan_id', $pesanan->id)->count();
            }else{
                $this->jumlah =0;
            }
        }
    }

    // kita menggunakan function mount ketika komponen navbar terpasang
    public function mount()
    {
        if (Auth::user()) {
            // kita membuat variable untuk pesanan yang identik dari user ini
            $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if ($pesanan) {
                $this->jumlah = PesananDetail::where('pesanan_id', $pesanan->id)->count();
            }else{
                $this->jumlah =0;
            }
        }
    }
    public function render()
    {
        // pertama membuat variable
        return view('livewire.navbar', [
            // menambahkan database dari liga
            'ligas' => Liga::all(),
            // setelah $jumlah = 0 kemudian kita keluarkan disini
            'jumlah_pesanan' => $this->jumlah
            // setelah menambahkan kita lakukan perulanan di navbar
        ]);
    }
}
