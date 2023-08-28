<!-- resources/views/emails/contact-form.blade.php -->

@component('mail::message')
# New Contact Form Submission

**Name:** {{ $name }}

**Email:** {{ $email }}

**Message:** {{ $message }}
@endcomponent
