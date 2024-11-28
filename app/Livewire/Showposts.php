<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class Showposts extends Component
{
    // public $titulo;

    // public function mount($title){
    //     $this->titulo = $title;
    // }
    public function render()
    {
        $posts = Post::all();
        return view('livewire.showposts', compact('posts'));
    }
}
