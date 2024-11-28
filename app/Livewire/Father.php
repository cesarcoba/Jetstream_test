<?php

namespace App\Livewire;

use Livewire\Component;

class Father extends Component
{
    public $name = 'yo mero';

    public function redirigir(){

        return $this->redirect('/prueba', navigate:true);
    }

    public function render()
    {
        return view('livewire.father');
    }


}
