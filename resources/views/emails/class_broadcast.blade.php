<x-mail::message>
# New Class Announcement

{{ $messageContent }}

<x-mail::button :url="$link">
Join Class Now
</x-mail::button>

See you in class!<br>
{{ config('app.name') }}
</x-mail::message>
