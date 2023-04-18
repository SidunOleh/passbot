@if (count($sites))
@foreach ($sites as $site)
{{ $site->name }}
<a href="asd">/sites {{ $site->name }}</a>
{{ $site->url }}

=================================================

@endforeach
@else
Not Found
@endif