<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Prueba
        </h2>
    </x-slot>

    @persist('player')
    <audio src="{{asset('audios/prueba.mp3')}}" controls></audio>
    @endpersist

    <script>
        // console.log('hola desde la prueba');
        // let a = 0;

        // setInterval(()=>{
        //     a++;
        //     console.log(a);
        // }, 1000);
    </script>
</x-app-layout>
