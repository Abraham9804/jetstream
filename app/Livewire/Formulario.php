<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Pest\Plugins\Only;

class Formulario extends Component
{
    public $postId;
    public $categories, $tags;
    public $category_id = "", $title, $content;
    public $selectedTags = [];
    public $posts;
    public $openEdit = false;
    public $postEdit = [
        'title' => '',
        'content' => '',
        'category_id' => '',
        'tags' => []
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::with('category', 'tags')->get();
    }

    public function save()
    {
        $post = Post::create(
             $this->only('category_id', 'title', 'content')
        );

        $post->tags()->attach($this->selectedTags);
        $this->reset('category_id', 'title', 'content', 'selectedTags');
        $this->posts = Post::with('category', 'tags')->get();
    }

    public function edit($postId)
    {
        $this->openEdit = true;
        $this->postId = $postId;
        $post = Post::with('tags')->find($postId);
        
        $this->postEdit = [
            'title' => $post->title,
            'content' => $post->content,
            'category_id' => $post->category_id,
            'tags' => $post->tags->pluck('id')->toArray()
        ];
        
    }

    public function update()
    {
        $post = Post::find($this->postId);
        $post->update($this->postEdit);
        $post->tags()->sync($this->postEdit['tags']);

        $this->posts = Post::with('category', 'tags')->get();
        $this->reset('postEdit', 'openEdit', 'postId');
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
