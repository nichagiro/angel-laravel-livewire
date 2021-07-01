@component('mail::message')
{{$data['msg']}}

@component('mail::button', ['url' => 'https://www.youtube.com', 'color' => 'red'])
Visitar
@endcomponent


Mensaje enviado desde,<br>
<i style="font-weight: bolder; color: rgb(0, 189, 157)">{{ config('app.name') }}</i>

@endcomponent
