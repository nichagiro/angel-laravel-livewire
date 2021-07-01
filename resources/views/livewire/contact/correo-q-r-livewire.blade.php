    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Correo de contacto y sugerencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex">
                <div wire:loading wire:target="sendEmail">
                    <x-sppiner color="pink"></x-sppiner>
                </div>
                <div class="w-1/2 p-4">
                    {{-- <x-jet-validation-errors></x-jet-validation-errors> --}}
                    <x-alert :msg="session('msg')" :bg="session('bg')"></x-alert>
                    <x-jet-form-section submit="sendEmail">
                        <x-slot name="title"> Formulario de peticion</x-slot>
                        <x-slot name="description"> llena todos los campos</x-slot>
                        <x-slot name="form">
                            <div class="flex justify-center">                          
                                <div class="w-1/2 px-4">
                                    <label wire:loading.class="hidden" wire:target="name">Nombre:</label>
                                    <label class="hidden" wire:loading.class.remove="hidden" wire:loading.class="text-pink-700 block" wire:target="name">escribiendo...</label>
                                    <input wire:model="name" type="text" name="name" class="w-full">
                                    <x-jet-input-error for="name"></x-jet-input-error>
                                </div>
                                <div class="w-1/2 px-4">
                                    <label> Correo:</label>
                                    <input wire:model="email" type="email" name="email" class="w-full">
                                    <x-jet-input-error for="email"></x-jet-input-error>
                                </div>
                            </div>
                            <div class="flex justify-center my-4">
                                <div class="w-1/2 px-4">
                                    <label wire:loading.class="text-pink-700" wire:target="subject">Asunto:</label>
                                    <input wire:model="subject" type="text" name="subject" class="w-full">
                                    <x-jet-input-error for="subject"></x-jet-input-error>
                                </div>
                                <div class="w-1/2 px-4">
                                    <label wire:loading.class="text-pink-700" wire:target="phone">Telefono:</label>
                                    <input wire:model="phone" type="number" name="phone" class="w-full">
                                    <x-jet-input-error for="phone"></x-jet-input-error>
                                </div>
                            </div>
                            <div class="flex px-4">
                                <div class="w-1/2 ">
                                    <label wire:loading.class="text-pink-700" wire:target="msg">Mensaje</label>
                                    <textarea wire:model="msg" name="msg" rows="5" class="resize-none w-full" ></textarea>
                                    <x-jet-input-error for="msg"></x-jet-input-error>
                                </div>
                                <div class="flex flex-wrap content-end w-1/2">
                                    <div class="flex justify-center w-full">
                                        <x-jet-button wire:loading.attr="disabled" wire:target="sendEmail">Enviar</x-jet-button>
                                    </div>
                                </div>
                            </div>
                        </x-slot>
                    </x-jet-form-section>
                </div>
                <div class="w-1/2">
                    <img style="height: 470px; object-fit:cover;" src="https://esports.as.com/2019/04/26/bonus/cine--series-y-anime/Vengadores-Endgame_1239786034_195960_1440x810.jpg" >
                </div>
            </div>
        </div>
    </div>
