<?php

namespace App\Livewire;

use Livewire\Component;

class Comments extends Component
{
    public $comments = [
        'articulo 1 creado',
        'articulo 2 creado',
        'articulo 3 creado',
    ];
    public function render()
    {
        return view('livewire.comments');
    }
}
