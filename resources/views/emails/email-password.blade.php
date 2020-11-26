@component('mail::message')

    @lang('auth.welcome', ['name' => $user->name]),
    <br>

    Por favor, ingrese por medio del siguiente enlace para cambiar su contraseña

    <br>

    @component('mail::button', [
        'url' => url('/create-password/' . base64_encode($user->email.'|'.$user->password))
    ])
        @lang('auth.change_password')
    @endcomponent

    {{ config('app.name') }}
@endcomponent
