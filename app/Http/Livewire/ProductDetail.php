<?php

namespace App\Http\Livewire;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public $product, $nameset, $jumlah_pesanan, $nomor, $nama;
    public function mount($id)
    {
        $ProductDetail = Product::find($id);
        
        if ($ProductDetail) {
            // $this->liga bersal dari pemanggilan di line 11
            $this->product = $ProductDetail;
        }
    }

    public function masukkanKeranjang(){
        // kita validasi dulu apakah user sudah login atau belum
        if(!Auth::user()){
            return redirect()->route("login");
        }

        // menghitung total harga
        if(!empty($this->nama)){
            $total_harga = $this->jumlah_pesanan*$this->product->harga+$this->product->harga_nameset;
        }else{
            $total_harga = $this->jumlah_pesanan*$this->product->harga;
        }

        // apakah user sudah punya  data pesanan utama yang status masih 0
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

        // menyimpan / update data pesanan utama
        if (empty($pesanan)) {
            Pesanan::create([
                'user_id' => Auth::user()->id,
                'total_harga' => $total_harga,
                'status' => 0,
                'kode_unik' => mt_rand(100,999),
            ]);
            // jika user sdh punya data dan status masih nol kemudian di create pesananya kemudian membuat kode unik untuk pemesanan
            $pesanan = Pesanan::Where('user_id', Auth::user()->id)->Where('status',0)->first();
            $pesanan->kode_pesanan = 'JP-' .$pesanan->id;
            $pesanan->update();
            
        }else{
            $pesanan->total_harga = $pesanan->total_harga+$total_harga;
            $pesanan->update();
        }

        // menyimpan data pesanan detail
        PesananDetail::create([
            'pesanan_id' => $pesanan->id,
            'product_id'=> $this->product->id,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'nameset'=> $this->nama ? true : false,
            'nama' => $this-> nama,
            'nomor' => $this-> nomor,
            'total_harga' => $total_harga
        ]);

        // membuat jumlah di keranjang realtime menggunakan emit
        $this->emit('masukkanKeranjang');
        
        session()->flash('message','pesanan telah masuk keranjang');

        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.product-detail')
        ->extends('layouts.app');
    }
}
