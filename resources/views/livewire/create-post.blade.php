<div>
    <h1>{{$title}}</h1>
    <input type="text" wire:model="name"/>
    <x-button wire:click="save()">guardar</x-button>
    <h2>{{$name}}</h2>
</div>
