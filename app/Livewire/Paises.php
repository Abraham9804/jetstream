<?php

namespace App\Livewire;

use Livewire\Component;

class Paises extends Component
{
    public $contador = 0;
    public $paises = [
        'Argentina',
        'Brasil',
        'Chile'
    ];
    public $mostrar = true;
    
    public $pais;
    public $paisSeleccionado;

    public function submit(){
        $this->paises[] = $this->pais;
        $this->reset('pais'); // Reset the input field after submission
    }

    public function delete($index)
    {
        unset($this->paises[$index]);
    }

    public function enviar()
    {
        dd($this->pais);
    }

    public function resaltar($pais)
    {
        $this->paisSeleccionado = $pais;
    }

    public function incrementar()
    {
        $this->contador++;
    }

    public function render()
    {
        return view('livewire.paises');
    }
}
