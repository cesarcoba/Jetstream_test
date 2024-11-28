<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Rule;

class PostEditForm extends Form
{
    //
    public $open = false;
    public $postId = '';

    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule('required|exists:categories,id')]
    public $category_id = '';

    #[Rule('required|array')]
    public $tags = [];

    public function edit($postId)
    {

        // $this->resetValidation();

        $this->open = true;

        $this->postId = $postId;

        $post = Post::find($postId);

        $this->category_id = $post->category_id;
        $this->title = $post->title;
        $this->content = $post->content;

        $this->tags = $post->tags->pluck('id')->toArray();
        // dump($this->postEditId);
    }

    public function update()
    {
        $this->validate();

        $post = Post::find($this->postId);

        $post->update(
            $this->only('title', 'content', 'category_id')
        );

        $post->tags()->sync($this->tags);

        $this->reset();
        // $this->open = false;


        // $this->posts = Post::all();
        // $this->dispatch('post-created', 'articulo editado');
    }

}
