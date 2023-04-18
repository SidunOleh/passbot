@if (count($sites))
@foreach ($sites as $site)
{{ $site->name }}
<a href="/sites {{ $site->name }}">/sites {{ $site->name }}</a>
"/sites {{ $site->name }}"
{{ $site->url }}

=================================================

@endforeach
@else
Not Found
@endif