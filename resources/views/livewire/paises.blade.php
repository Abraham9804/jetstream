<div>
    @livewire('hijo')
    <x-button wire:click="$set('contador', 0)">Resetear</x-button>
    <x-button wire:click="$toggle('mostrar')">Mostrar / ocultar</x-button>
    <form wire:submit="submit">
        <x-input wire:model="pais" wire:keydown.enter="enviar" placeholder="Ingrese el pais"></x-input>
        
    </form>
    @if($mostrar)
    <ul>
        @foreach($paises as $index => $pais)
        <li wire:key="{{$index}}" class="mb-2">
            <span wire:mouseover="resaltar('{{$pais}}')">{{$index}} - {{$pais}}</span>
            <x-danger-button wire:click="delete({{$index}})">X</x-danger-button>
        </li>
        @endforeach
    </ul>
    @endif
    <p >{{ $contador }}</p>

</div>
