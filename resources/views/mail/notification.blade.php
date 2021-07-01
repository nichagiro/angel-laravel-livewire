@component('mail::message')
<h2 style="font-weight: bolder; color: #4655">UN BLOG HA SIDO ACTUALIZADO !</h2> <br><br>

{{$blog->body}} <br><br>

{{ config('app.name') }}

@component('mail::button', ['url' => $url])
Ver blog
@endcomponent

@component('mail::footer')
Esta es una notificación de un blog que ha sido gestionado.
@endcomponent


@endcomponent
