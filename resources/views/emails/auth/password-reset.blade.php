@component('mail::message')
# Introduction

Message for : {{$email}}
Click on the button below to reset your password
@component('mail::button', ['url' => $url])
Password Reset Link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent