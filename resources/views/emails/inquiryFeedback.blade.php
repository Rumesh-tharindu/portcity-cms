@component('mail::message')

Dear {{$inquiry['first_name'] ?? ''}} {{$inquiry['last_name'] ?? ''}},<br>

Your {{$inquiry['inquiry'] ?? ''}} {{ $inquiry['type'] ?? '' }} received.<br>
Thank you for contacting us.<br>
We will get back to you at our earliest.
<br>
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
