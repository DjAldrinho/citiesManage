@component('mail::message')

    @lang('auth.welcome', ['name' => $user->name]),
    <br>
    @lang('auth.invitation_password', ['password' => $user->password])

    @component('mail::button', [
        'url' => url('/create-password/' . base64_encode($user->email.'|'.$user->password))
    ])
        @lang('auth.change_password')
    @endcomponent

    {{ config('app.name') }}
@endcomponent
