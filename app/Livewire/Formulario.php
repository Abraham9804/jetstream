<?php

namespace App\Livewire;

use App\Livewire\Forms\CreatePostForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Pest\Plugins\Only;

class Formulario extends Component
{
    public $postId;
    public $categories, $tags;
    public $posts;
    public $openEdit = false;
    public $postEdit = [
        'title' => '',
        'content' => '',
        'category_id' => '',
        'tags' => []
    ];

    public CreatePostForm $createPostForm;

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::with('category', 'tags')->get();
    }

    public function save()
    {
        $this->createPostForm->save();
        
        $this->posts = Post::with('category', 'tags')->get();
    }

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

        $this->posts = Post::with('category', 'tags')->get();
        $this->reset('postEdit', 'openEdit', 'postId');
    }

    public function destroy($postId)
    {
       $post = Post::find($postId);
       $post->delete();
       $this->posts = Post::with('category', 'tags')->get();
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
