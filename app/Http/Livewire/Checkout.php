<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Pesanan;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $total_harga, $nohp, $alamat;

    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $this->nohp = Auth::user()->nohp;
        $this->alamat = Auth::user()->alamat;

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (!empty($pesanan)) {
            $this->total_harga = $pesanan->total_harga + $pesanan->kode_unik;
        } else {
            return redirect()->route('home');
        }
    }
    public function checkout()
    {
        // kita validasi terlebih dahulu
        $this->validate([
            'nohp' => 'required',
            'alamat' => 'required'
        ]);

        // simpan
        $user = User::where('id', Auth::user()->id)->first();
        $user->nohp = $this->nohp;
        $user->alamat = $this->alamat;
        $user->update();

        // update data pesanana
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->status = 1;
        $pesanan->update();

        $this->emit('masukkanKeranjang');

        session()->flash('message', 'success checkout');

        return redirect()->route('history');
    }
    public function render()
    {

        return view('livewire.checkout')
            ->extends('layouts.app');
    }
}
