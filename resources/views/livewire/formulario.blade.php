<div>
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="font-semibold text-lg text-gray-800 mb-6">Formulario</h2>
        <form wire:submit="save" novalidate>
            <div>
                <x-label for="title" value="Titulo" />
                <x-input id="title" type="text" class="mt-1 block w-full" autofocus wire:model="title" />
            </div>
            <div>
                <x-label for="content" value="Contenido" />
                <x-textarea id="content" class="mt-1 block w-full" rows="3" wire:model="content">
                    {{ old('content') }}
                </x-textarea>
            </div>
            <div>
                <x-label for="category_id" value="Categoria" />
                <x-select id="category_id" class="mt-1 block w-full" wire:model="category_id">
                    <option value="" disabled>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <x-label for="tags" value="Tags" />
                <ul>
                    @foreach($tags as $tag)
                        <li>
                            <label for="{{$tag->id}}" value="{{$tag->name}}">
                                <x-checkbox id="{{$tag->id}}" value="{{$tag->id}}" wire:model="selectedTags" />
                                {{$tag->name}}
                            </label>
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
                <li class="border-b border-gray-200 py-4">
                    <h3 class="font-semibold text-gray-800">{{ $post->title }}</h3>
                    <p class="text-gray-600">{{ $post->content }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
