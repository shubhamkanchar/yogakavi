<x-mail::message>
# New Contact Inquiry

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Subject:** {{ $data['subject'] }}

## Message:
{{ $data['message'] }}

<x-mail::button :url="config('app.url')">
View Website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
