<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Pest\Plugins\Only;

class Formulario extends Component
{
    public $categories, $tags, $posts;
    public $category_id = "", $title, $content;
    public $selectedTags = [];

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::all();
    }

    public function save()
    {
        /*dd([
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'selectedTags' => $this->selectedTags,
        ]);*/

        $post = Post::create($this->only(['category_id', 'title', 'content']));
        $post->tags()->attach($this->selectedTags);
        $this->reset(['category_id', 'title', 'content', 'selectedTags']);
        $this->posts = Post::all(); // Refresh the posts list
    }
    
    public function render()
    {
        return view('livewire.formulario');
    }
}
