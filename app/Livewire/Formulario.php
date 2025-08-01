<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class Formulario extends Component
{
    public $categories, $tags;
    public $category_id = "", $title, $content;
    public $selectedTags = [];
    public $posts;

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::with('category', 'tags')->get();
    }

    public function save()
    {
        /*Post::create([
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'selectedTags' => $this->selectedTags,
        ]);*/

        $post = Post::create(
             $this->only('category_id', 'title', 'content')
        );

        $post->tags()->attach($this->selectedTags);
        $this->reset('category_id', 'title', 'content', 'selectedTags');
        $this->posts = Post::with('category', 'tags')->get();
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
