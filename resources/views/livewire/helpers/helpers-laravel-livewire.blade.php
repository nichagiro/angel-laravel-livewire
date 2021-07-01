<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Helpers de laravel v*8.0') }}
        </h2>
    </x-slot>
    <div wire:loading>
        <x-sppiner></x-sppiner>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex">
                <div class="w-1/2">
                    <div class="m-4">
                        <b class="text-red-500 italic mb-1"> Texto </b>
                        {{$text}}
                    </div>
                    <div class="m-4">
                        <b class="text-red-500 italic mb-1"> Array </b>
                        <ul>
                            <li>
                                <strong class="text-red-600 text-3xl mr-2">.</strong>{{$array['name']}}
                            </li>
                            <li>
                                <strong class="text-red-600 text-3xl mr-2">.</strong>{{$array['genero']}}
                            </li>
                            <li>
                                <strong class="text-red-600 text-3xl mr-2">.</strong>{{$array['age']}}
                            </li>
                            <li>
                                <strong class="text-red-600 text-3xl mr-2">.</strong>{{$array['peso']}}
                            </li>
                            <li class="pb-4">
                                <x-jet-button onclick="modal()" color="purple">Conexion js</x-jet-button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-1/2 border-l-2 border-purple-200 flex flex-wrap">
                    @foreach ($accion as $ac)
                        <div class="m-2">
                            <x-jet-button  wire:click="{{$ac}}">{{$ac}}</x-jet-button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function modal(){
            Swal.fire({
                title: 'Are you sure? ',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                } else {
                    livewire.emit('modal','ANGELA ROJAS');
                    window.addEventListener('modal_response', event => {
                        Swal.fire(
                            'Alert!',
                            'No se borro a'+ event.detail.nombre,
                            'info'
                        )
                    })
                }
            })
        }
    </script>
</div>
