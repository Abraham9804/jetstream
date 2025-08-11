<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreatePostForm extends Form
{
    public $category_id = "", $title, $content;
    public $selectedTags = [];
   /* #[Rule('required|min:3|max:255')]
    public $title;*/
    
    
    public function save()
    {
        $this->validate([
                    'category_id' => 'required|exists:categories,id',
                    'title' => 'required|string|min:3|max:255',
                    'content' => 'required|string',
                    'selectedTags' => 'array',
                    'selectedTags.*' => 'exists:tags,id',
                ],
                [
                    'category_id.required' => 'La categoría es obligatoria.',
                    'title.required' => 'El título es obligatorio.',
                    'title.min' => 'El título debe tener al menos 3 caracteres.',
                    'content.required' => 'El contenido es obligatorio.',
                    'selectedTags.array' => 'Las etiquetas deben ser un arreglo.',
                    'selectedTags.*.exists' => 'Una o más etiquetas seleccionadas no existen.'
                ]);

        $post = Post::create(
             $this->only('category_id', 'title', 'content')
        );
        $post->tags()->attach($this->selectedTags);

        $this->reset('category_id', 'title', 'content', 'selectedTags');
        
    }
}