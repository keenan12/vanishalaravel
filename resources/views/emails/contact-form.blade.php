@component('mail::message')
# Pesan Baru dari Contact Form

Anda menerima pesan baru dari website Vanisha Bakery.

**Dari:** {{ $contactData['name'] }}  
**Email:** {{ $contactData['email'] }}

---

**Pesan:**

{{ $contactData['message'] }}

---

@component('mail::button', ['url' => 'mailto:' . $contactData['email']])
Balas Email
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
