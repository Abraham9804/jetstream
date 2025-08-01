<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;

class Formulario extends Component
{
    public $categories, $tags;
    public $category_id, $title, $content;
    public $selectedTags = [];

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function save()
    {
        dd([
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'selectedTags' => $this->selectedTags,
        ]);
    }
    public function render()
    {
        return view('livewire.formulario');
    }
}
