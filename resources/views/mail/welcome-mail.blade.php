@component("mail::message")
    # Welcome, {{ $name }}
    
    Thanks,
    {{ config('app.name') }}
@component('mail::button', ['url' => 'google.com'])
    Google
@endcomponent
@endcomponent

