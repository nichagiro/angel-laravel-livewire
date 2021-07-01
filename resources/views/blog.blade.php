@auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="{{ route('post') }}">
                    <x-jet-button color="purple" class="my-3 mx-6">Regresar</x-jet-button> 
                </a>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <img src="{{$blog->img}}"  width="500" height="500" class="float-left mr-8 p-5">
                    <div class="py-2 px-8 text-justify">
                        {{$blog->body}}
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endauth

@guest
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{$blog->img}}"  width="500" height="500" class="float-left mr-8 p-5">
                <div class="py-2 px-8 text-justify">
                    {{$blog->body}}
                </div>
            </div>
        </div>
    </div>
@endguest


