<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class Children extends Component
{
    // #[Reactive]
    #[Modelable]
    public $name;

    public function render()
    {
        return view('livewire.children');
    }
}
