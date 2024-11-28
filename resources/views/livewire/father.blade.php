<div>
    {{-- Be like water. --}}

    @persist('player')
        <audio src="{{asset('audios/prueba.mp3')}}" controls></audio>
    @endpersist

    <x-button wire:click="redirigir">
        Ir a prueba
    </x-button>
    <h1 class="text-2xl font-semibold">padre</h1>
    <hr>

    <x-input wire:model.live="name"></x-input>

    <hr class="my-6">
    <div>
        {{-- @livewire('children',[
            'name'=> $name
            ]) --}}

        <livewire:children wire:model="name" />
    </div>
    <script>
        // console.log('hola desde el padre');
    </script>
</div>
