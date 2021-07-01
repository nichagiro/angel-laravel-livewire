@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600 p-2">{{ __('Whoops! se encotraron errores') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600 p-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
