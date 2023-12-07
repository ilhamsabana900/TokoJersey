<?php

namespace App\Http\Livewire;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Keranjang extends Component
{
    protected $pesanan;
    protected $pesanan_details=[];

    public function destroy($id){
        $pesanan_Detail = PesananDetail::find($id);

        if(!empty($pesanan_Detail)){
            // maka kita cek
            $pesanan = Pesanan::where('id', $pesanan_Detail->pesanan_id)->first();
            // pengkondisian
            $jumlah_pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->count();
            if($jumlah_pesanan_detail == 1){
                $pesanan->delete();
            }else{
                $pesanan->total_harga = $pesanan->total_harga-$pesanan_Detail->total_harga;
                $pesanan->update();
            }

            $pesanan_Detail->delete();

            $this->emit('masukkanKeranjang');
        
            session()->flash('message','pesanan telah dihapus');
    
        }
    }
    public function render()
    {
        // jika kita memanggil Auth::user()->id maka kita harus validasi terlebih dahulu menggunakan if
        if(Auth::user()){
            $this->pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if($this->pesanan)
            {
                $this->pesanan_details=PesananDetail::where('pesanan_id', $this->pesanan->id)->get();
            }
        }
       

        return view('livewire.keranjang',[
            'pesanan'=>$this->pesanan,
            'pesanan_details'=> $this->pesanan_details
        ])
        ->extends('layouts.app');;
    }
}
