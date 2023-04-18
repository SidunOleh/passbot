@if (count($sites))
@foreach ($sites as $site)
{{ $site->name }}
<a href="asd">asd</a>
{{ $site->url }}

=================================================

@endforeach
@else
Not Found
@endif