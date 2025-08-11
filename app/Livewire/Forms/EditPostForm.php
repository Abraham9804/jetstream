<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditPostForm extends Form
{
    public $openEdit = false;
    public $postId;

    public $postEdit = [
        'title' => '',
        'content' => '',
        'category_id' => '',
        'tags' => []
    ];

    public function edit($postId)
    {
        $this->resetValidation();
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

        $this->validate([
            'postEdit.title' => 'required|string|max:255',
            'postEdit.content' => 'required|string',
            'postEdit.category_id' => 'required|exists:categories,id',
            'postEdit.tags' => 'array',
            'postEdit.tags.*' => 'exists:tags,id',
        ],[
            'postEdit.title.required' => 'El título es obligatorio.',
            'postEdit.title.string' => 'El título debe ser una cadena de texto.',
            'postEdit.title.max' => 'El título no puede exceder los 255 caracteres.',
            'postEdit.content.required' => 'El contenido es obligatorio.',
            'postEdit.content.string' => 'El contenido debe ser una cadena de texto.',
            'postEdit.category_id.required' => 'La categoría es obligatoria.',
            'postEdit.category_id.exists' => 'La categoría seleccionada no existe.',
            'postEdit.tags.array' => 'Las etiquetas deben ser un arreglo.',
            'postEdit.tags.*.exists' => 'Una o más etiquetas seleccionadas no existen'
        ]);

        $post->update($this->postEdit);
        $post->tags()->sync($this->postEdit['tags']);

        
        $this->reset('postEdit', 'openEdit', 'postId');
    }
}
