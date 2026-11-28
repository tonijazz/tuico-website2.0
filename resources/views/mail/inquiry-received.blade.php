<p>A new enquiry was submitted on the TUICO website. Reply to this email to answer the sender directly.</p>

<table cellpadding="6" style="border-collapse: collapse;">
    <tr><td><strong>Type</strong></td><td>{{ $inquiry->type?->getLabel() }}</td></tr>
    <tr><td><strong>Name</strong></td><td>{{ $inquiry->name }}</td></tr>
    <tr><td><strong>Email</strong></td><td>{{ $inquiry->email }}</td></tr>
    @if ($inquiry->phone)
        <tr><td><strong>Phone</strong></td><td>{{ $inquiry->phone }}</td></tr>
    @endif
    @if ($inquiry->workplace)
        <tr><td><strong>Workplace</strong></td><td>{{ $inquiry->workplace }}</td></tr>
    @endif
    @if ($inquiry->office)
        <tr><td><strong>Region</strong></td><td>{{ $inquiry->office->name }}</td></tr>
    @endif
    @if ($inquiry->subject)
        <tr><td><strong>Subject</strong></td><td>{{ $inquiry->subject }}</td></tr>
    @endif
</table>

<p><strong>Message</strong></p>
<p>{!! nl2br(e($inquiry->message)) !!}</p>

<p>Mark it as resolved in the admin once answered: <a href="{{ url('/admin') }}">{{ url('/admin') }}</a></p>