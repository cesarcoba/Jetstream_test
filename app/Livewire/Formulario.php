<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Formulario extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $categories, $tags;
    // public $posts;

    public $category_id = '', $title, $content;

    public $selectedTags = [];

    // public $open = false;
    // public $postEditId = '';

    public PostCreateForm $postCreate;
    public PostEditForm $postEdit;

    #[Url(as: 's')]
    public $search = '';

    // public $postEdit = [
    //     'category_id' => '',
    //     'title' => '',
    //     'content' => '',
    //     'tags' => []
    // ];

    // #[Rule([
    //     'postCreate.title' => 'required',
    //     'postCreate.content' => 'required',
    //     'postCreate.category_id' => 'required|exists:categories,id',
    //     'postCreate.tags' => 'required|array'
    // ],[],[
    //     'postCreate.category_id' => 'categoria'
    // ])]

    // public $postCreate = [
    //     'category_id' => '',
    //     'title' => '',
    //     'content' => '',
    //     'tags' => []
    // ];


    // public function rules(){
    //     return[
    //         'postCreate.title' => 'required',
    //         'postCreate.content' => 'required',
    //         'postCreate.category_id' => 'required|exists:categories,id',
    //         'postCreate.tags' => 'required|array'
    //     ];
    // }

    // public function messages(){
    //     return[
    //         'postCreate.title.required' => 'El titulo es requerido',
    //     ];
    // }

    // public function validationAttributes()
    // {
    //     return[
    //         'postCreate.category_id' => 'categoria'
    //     ];
    // }

    public function mount(){
        $this->categories = Category::all();
        $this->tags = Tag::all();
        // $this->posts = Post::all();
    }

    public function updating($property, $value){
        // dump($value);
        // dd($property);
    }

    public function updated($property, $value)
    {
        // dump($value);
        // dd($property);
    }

    public function hydrate(){

    }

    public function dehydrate()
    {

    }

    public function save(){

        // $this->postCreate->validate();

        // $this->validate();

        // $this->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'selectedTags' => 'required|array'
        // ],[
        //     'title.required' => 'El campo título es requerido',
        // ],[
        //     'category_id' => 'Categoria'
        // ]);

        // $post = Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content
        // ]);

        // $post = Post::create(
        //     $this->only('category_id', 'title', 'content')
        // );

        // $post = Post::create(
        //     $this->postCreate->only('title', 'content','category_id')
        // );

        // $post = Post::create(
        //     [
        //         'category_id' => $this->postCreate['category_id'],
        //         'title' => $this->postCreate['title'],
        //         'content' => $this->postCreate['content']
        //     ]
        // );

        // $post->tags()->attach($this->selectedTags);
        // $post->tags()->attach($this->postCreate['tags']);
        // $post->tags()->attach($this->postCreate->tags);

        // $this->reset(['category_id', 'title', 'content', 'selectedTags']);
        // $this->reset(['postCreate']);
        // $this->postCreate->reset(['title', 'content', 'category_id','tags']);
        // $this->postCreate->reset();


        $this->postCreate->save();
        // $this->posts = Post::all();

        $this->resetPage(pageName: 'pagePosts');

        $this->dispatch('post-created','Nuevo articulo creado new');
    }

    public function edit($postId){

        $this->resetValidation();

        // $this->open = true;

        // $this->postEditId = $postId;

        // $post = Post::find($postId);

        // $this->postEdit['category_id'] = $post->category_id;
        // $this->postEdit['title'] = $post->title;
        // $this->postEdit['content'] = $post->content;

        // $this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
        // dump($this->postEditId);

        $this->postEdit->edit($postId);
    }

    public function update(){

        // $this->validate([
        //     'postEdit.title' => 'required',
        //     'postEdit.content' => 'required',
        //     'postEdit.category_id' => 'required|exists:categories,id',
        //     'postEdit.tags' => 'required|array'
        // ], [
        //     'title.required' => 'El campo título es requerido',
        // ], [
        //     'category_id' => 'Categoria'
        // ]);

        // $post = Post::find($this->postEditId);
        // // dump($this->postEdit);

        // $post->update([
        //     'category_id' => $this->postEdit['category_id'],
        //     'title' => $this->postEdit['title'],
        //     'content' => $this->postEdit['content']
        // ]);

        // $post->update([
        //     'category_id' => 2,
        //     'title' => 'title forzado',
        //     'content' => 'content forzado'
        // ]);

        // dump($this->postEdit);
        // $post->category_id = $this->postEdit['category_id'];
        // $post->title = $this->postEdit['title'];
        // $post->content = $this->postEdit['content'];
        // $post->save();


        // $post->tags()->sync($this->postEdit['tags']);
        // $this->reset(['open']);
        // $this->open = false;
        // $this->reset(['postEditId', 'postEdit', 'open']);

        $this->postEdit->update();
        // $this->posts = Post::all();
        $this->dispatch('post-created', 'articulo editado');
    }

    public function destroy($postId){
        $post = Post::find($postId);
        $post->delete();
        // $this->posts = Post::all();
        $this->dispatch('post-created', 'articulo eliminado');
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div>
                <p> Cargando ...</p>
            </div>
        HTML;
    }

    public function render()
    {
        $posts = Post::orderBy('id','desc')
        ->when($this->search, function($query){
            $query->where('title','like','%'.$this->search.'%');
        })
            ->paginate(5, pageName: 'pagePosts');
        return view('livewire.formulario', compact('posts'));
    }
}
