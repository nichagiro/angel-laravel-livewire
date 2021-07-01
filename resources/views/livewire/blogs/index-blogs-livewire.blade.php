<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Blogs') }} 
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-100">
            <x-alert :msg="session('msg')" :bg="session('bg')"></x-alert>
            <x-notify-component :msg1="session('msg1')" :bg1="session('bg1')"></x-notify-component>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex">
            <div wire:loading>
                <x-sppiner color="pink"></x-sppiner>
            </div>
            {{-- MODAL UPDATE --}}
            @if ($modal_update)            
                <x-jet-modal id="modal_update" maxWidth="2xl">
                    <x-jet-validation-errors></x-jet-validation-errors>
                    <div class="p-6">
                        <x-jet-label value="Titulo"></x-jet-label>
                        <x-jet-input wire:model.defer="blog_update.title" class="w-full" type="text"></x-jet-input>
                    </div>
                    <div class="p-6">
                        <x-jet-label value="Imagen"></x-jet-label>
                        {{-- img --}}
                        <x-jet-input wire:model="img_update" class="w-full" type="file"></x-jet-input>
                        <div wire:loading wire:target="img_update" class="flex p-6">
                            <span>
                                <x-sppiner size="sm"></x-sppiner>
                            </span>
                            <b class="text-small italic text-xs text-indigo-700 ml-2">Cargando...</b>
                        </div>
                        @isset ($img_update)
                            <img class="h-20 w-20" src="{{ $img_update->temporaryUrl() }}">
                        @endisset
                    </div>
                    <div class="p-6">
                        <x-jet-label value="Cuerpo"></x-jet-label>
                        <textarea wire:model.defer="blog_update.body" class="w-full" style="resize: none"></textarea>
                    </div>
                    <div class="p-6">
                        <x-jet-secondary-button wire:loading.attr="disabled" wire:click="modalUpdate"> Cerrar </x-jet-secondary-button>
                        <x-jet-button wire:loading.class="hidden" wire:target="img_update" color="yellow" wire:click="UpdateBlog">
                            <span wire:loading wire:target="UpdateBlog">
                                <x-sppiner size="sm" color="white"></x-sppiner>
                            </span>
                            Atualizar
                        </x-jet-button>
                    </div>
                </x-jet-modal>
            @endif
            {{-- MODAL CREATE --}}
            @if ($modal)            
                <x-jet-modal id="modal" maxWidth="2xl">
                    <x-jet-validation-errors></x-jet-validation-errors>
                    <div class="p-6">
                        <x-jet-label value="Titulo"></x-jet-label>
                        <x-jet-input wire:model.defer="blog.title" class="w-full" type="text"></x-jet-input>
                    </div>
                    <div class="p-6">
                        {{-- img --}}
                        <x-jet-label value="Imagen"></x-jet-label>
                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            {{-- file upload --}}
                            <x-jet-input wire:model.defer="blog.img" class="w-full" type="file"></x-jet-input>
                            {{-- Progress --}}
                            <div wire:loading wire:target="blog.img">
                                <b x-text="progress" class="text-blue-500 text-sm"></b>
                                <span class="text-blue-500 text-sm">%</span>
                            </div>
                            <!-- Progress Bar -->
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"> </progress>
                            </div>
                        </div>
                        <div wire:loading wire:target="blog.img" class="flex p-6">
                            <span>
                                <x-sppiner size="sm"></x-sppiner>
                            </span>
                            <b class="text-small italic text-xs text-indigo-700 ml-2">Cargando...</b>
                        </div>
                        @isset ($blog['img'])
                            <img class="h-20 w-20" src="{{ $blog['img']->temporaryUrl() }}">
                        @endisset
                    </div>
                    <div class="p-6">
                        <x-jet-label value="Cuerpo"></x-jet-label>
                        <textarea wire:model.defer="blog.body" class="w-full" style="resize: none"></textarea>
                    </div>
                    <div class="p-6">
                        <x-jet-secondary-button wire:loading.attr="disabled" wire:click="modalCreate"> Cerrar </x-jet-secondary-button>
                        <x-jet-button wire:loading.class="hidden" color="indigo" wire:click="StoreBlog"> Crear</x-jet-button>
                    </div>
                </x-jet-modal>
            @endif
            {{-- MODAL DELETE --}}
            @if ($modal_delete)
                <x-jet-confirmation-modal>
                    <x-slot name="title"> Eliminar</x-slot>
                    <x-slot name="content">Esta seguro de eliminar este elemento?</x-slot>
                    <x-slot name="footer">
                        <x-jet-danger-button wire:loading.attr="disabled" wire:click="DeleteBlog">
                            <div wire:loading wire:target="DeleteBlog">
                                <x-sppiner size="sm" color="white"></x-sppiner>
                            </div>
                            <span>
                                Eliminar
                            </span>
                        </x-jet-danger-button>
                        <x-jet-secondary-button class="ml-5" wire:click="modal_delete(null)"> Cancelar</x-jet-secondary-button>
                    </x-slot>
                </x-jet-confirmation-modal>
            @endif
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col w-full">
                <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="float-left ml-6 my-4">
                                <x-jet-button wire:loading.attr="disabled" wire:click="modalCreate" color="green">Crear</x-jet-button>
                            </div>
                            <x-jet-input wire:model.defer="search" type="search" class="float-right mr-6 my-4" placeholder="BUSCAR"></x-jet-input>
                            <table class="w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Titulo
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Autor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cuerpo
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Accion
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($blogs as $blog)                                        
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                <img wire:click="downloadImage({{$blog}})" class="cursor-pointer h-10 w-10 rounded-full" src="{{asset($blog->img)}}" alt="">
                                                </div>
                                                <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$blog->title}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{$blog->correo}}
                                                </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                            <div wire:click="FiltroAutor('{{$blog->autor}}')" class="text-sm text-gray-900 cursor-pointer hover:text-indigo-500">{{$blog->autor}}</div>
                                            <div class="text-sm text-gray-500">Usuario: {{$blog->users_id}}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <small class="italic lowercase">
                                                    {{Str::limit($blog->body,20)}}
                                                </small>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span wire:click="RouteShowBlog('{{$blog->id}}')" class="hover:bg-green-200 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 cursor-pointer">
                                                    ver
                                                </span>
                                                <span wire:click="modal_delete({{$blog}})" class="hover:bg-red-200 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 cursor-pointer">
                                                    eliminar
                                                </span>
                                                @can('update', $blog) 
                                                    <span wire:click="modalUpdate({{$blog}})" class="hover:bg-blue-200 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 cursor-pointer">
                                                        editar
                                                    </span>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-12 my-5 m-auto">
                                {{$blogs->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
