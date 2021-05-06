@component('mail::message')
# Introduction

Message for user with username: {{$username}}
User: {{$name}}
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
