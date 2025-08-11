<?php

namespace App\Livewire;

use App\Livewire\Forms\CreatePostForm;
use App\Livewire\Forms\EditPostForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Pest\Plugins\Only;

class Formulario extends Component
{
    
    public $categories, $tags; 
    public $posts;
    public CreatePostForm $createPostForm;
    public EditPostForm $editPostForm;

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
        $this->dispatch('toast', message: 'Post creado correctamente');
    }

    public function edit($postId)
    {
        $this->editPostForm->edit($postId);
        
    }

    public function update()
    {
        $this->editPostForm->update();
        $this->posts = Post::with('category', 'tags')->get();
        $this->dispatch('toast', message: 'Post actualizado correctamente');
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
