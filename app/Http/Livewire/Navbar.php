<?php

namespace App\Http\Livewire;

use App\Models\Liga;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.navbar',[
            // menambahkan database dari liga
            'ligas' => Liga::all()
            // setelah menambahkan kita lakukan perulanan di navbar
        ]);
    }
}
