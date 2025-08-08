<div>
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="font-semibold text-lg text-gray-800 mb-6">Formulario de creacion</h2>
        <form wire:submit="save" novalidate>
            <div class="mb-4">
                <x-label for="title" value="Titulo" />
                <x-input id="title" type="text" class="mt-1 block w-full" autofocus wire:model="createPostForm.title" />
                <x-input-error for="createPostForm.title"/>
            </div>
            <div class="mb-4">
                <x-label for="content" value="Contenido" />
                <x-textarea id="content" class="mt-1 block w-full" rows="3" wire:model="createPostForm.content">
                    {{ old('content') }}
                </x-textarea>
                <x-input-error for="createPostForm.content" />
            </div>
            <div class="mb-4">
                <x-label for="category_id" value="Categoria" />
                <x-select id="category_id" class="mt-1 block w-full" wire:model="createPostForm.category_id">
                    <option value="" disabled>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="createPostForm.category_id" />
            </div>
            <div class="mb-4">
                <x-label for="tags" value="Tags" />
                <ul>
                    @foreach($tags as $tag)
                        <li>
                            <label for="{{$tag->id}}" value="{{$tag->name}}">
                                <x-checkbox id="{{$tag->id}}" value="{{$tag->id}}" wire:model="createPostForm.selectedTags" />
                                {{$tag->name}}
                            </label>
                            <x-input-error for="createPostForm.selectedTags.{{$tag->id}}" />
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-6 flex justify-end">
                <x-button type="submit">
                    Submit
                </x-button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="font-semibold text-lg text-gray-800 mb-6">Posts</h2>
        <ul>
            @foreach($posts as $post)
                <li class="border-b border-gray-200 py-4 flex justify-between items-start" wire:key="post-{{ $post->id }}">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $post->title }}</h3>
                        <p class="text-gray-600">{{ $post->content }}</p>
                    </div>
                    <div>
                        <x-button wire:click="edit({{ $post->id }})">
                            Editar
                        </x-button>
                        <x-danger-button wire:click="destroy({{ $post->id }})" class="ml-2">
                            Eliminar
                        </x-danger-button>
                    </div>
                    
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Modal for Edit Form -->
    

    <x-dialog-modal wire:model="openEdit" maxWidth="2xl">
        <x-slot name="title">
            Editar Post
        </x-slot>

        <x-slot name="content">
            <form wire:submit="update" novalidate>
                <div>
                    <x-label for="titleEdit" value="Titulo" />
                    <x-input id="titleEdit" type="text" class="mt-1 block w-full" autofocus wire:model="postEdit.title" />
                    <x-input-error for="postEdit.title" />
                </div>
                <div>
                    <x-label for="contentEdit" value="Contenido" />
                    <x-textarea id="contentEdit" class="mt-1 block w-full" rows="3" wire:model="postEdit.content">
                        {{ old('content') }}
                    </x-textarea>
                    <x-input-error for="postEdit.content" />
                </div>
                <div>
                    <x-label for="category_idEdit" value="Categoria" />
                    <x-select id="category_idEdit" class="mt-1 block w-full" wire:model="postEdit.category_id">
                        <option value="" disabled>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="postEdit.category_id" />
                </div>
                <div>
                    <x-label for="tags" value="Tags" />
                    <ul>
                        @foreach($tags as $tag)
                            <li>
                                <label for="{{$tag->id}}Edit" value="{{$tag->name}}">
                                    <x-checkbox id="{{$tag->id}}Edit" value="{{$tag->id}}" wire:model="postEdit.tags"/>
                                    {{$tag->name}}
                                </label>
                            </li>
                            <x-input-error for="postEdit.tags.{{$tag->id}}" />
                        @endforeach
                    </ul>
                </div>
                
            </form>
        </x-slot>
        <x-slot name="footer">
            <div class="mt-6 flex justify-end">
                    <x-danger-button wire:click="$set('openEdit', false)" class="mr-3">
                        Cancel
                    </x-danger-button>
                    <x-button wire:click="update">
                        Submit
                    </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
