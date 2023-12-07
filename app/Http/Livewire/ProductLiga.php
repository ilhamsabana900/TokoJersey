<?php

namespace App\Http\Livewire;

use App\Models\Liga;
use App\Models\Product;
use Livewire\Component;

class ProductLiga extends Component
{
    public $search, $liga;
    
    protected $updateQueryString =['search'];

    // funtion ketika pertama kali dipasang atau di mount
    // parameter $ligaId didapat dari route {ligaId}
    public function mount($ligaId)
    {
        $ligaDetail = Liga::find($ligaId);

        if ($ligaDetail) {
            // $this->liga bersal dari pemanggilan di line 11
            $this->liga = $ligaDetail;
        }
    }

    public function render()
    {
        if ($this->search) {
            $products = Product::where('liga_id', $this->liga->id)->where('nama','like','%'. $this->search .'%')->paginate(8);
        }else{

            $products = Product::where('liga_id', $this->liga->id)->paginate(8);
        }
        return view('livewire.product-index',[
            'products'=>$products,
            'title'=>'List Jersey '.$this->liga->nama
        ])
        ->extends('layouts.app');
    }
}
