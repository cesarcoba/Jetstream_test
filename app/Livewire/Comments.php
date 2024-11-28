<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{
    public $comments = [];

    #[On('post-created')]
    public function addcomment($comment){
        array_unshift($this->comments, $comment);
    }
    public function render()
    {
        return view('livewire.comments');
    }
}
