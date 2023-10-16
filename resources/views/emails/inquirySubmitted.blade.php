@component('mail::message')

Hi,
<br>
New {{$inquiry['inquiry'] ?? ''}} {{ $inquiry['type'] ?? '' }} received.

### Reference ID: {{$inquiry['reference'] ?? ''}}
### Type: {{$inquiry['type'] ?? ''}}
### Submitted At: {{$inquiry['submitted_at'] ?? ''}}
### First Name: {{$inquiry['first_name'] ?? ''}}
### Last Name: {{$inquiry['last_name'] ?? ''}}
### Email: {{$inquiry['email'] ?? ''}}
### Phone Number: {{$inquiry['contact_number'] ?? ''}}
### Country: {{$inquiry['country'] ?? ''}}
### Company: {{$inquiry['company'] ?? ''}}
### Message:

{{$inquiry['message'] ?? ''}}
<br>

{{ config('app.name') }}
@endcomponent
