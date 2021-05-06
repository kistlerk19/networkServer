@component('mail::message')
# Introduction

Message for : {{$name}}
Click on the button below to confirm your account
@component('mail::button', ['url' => $url])
Click to Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
