@if (count($sites))
@foreach ($sites as $site)
{{ $site->name }}

{{ $site->url }}

=================================================

@endforeach
@else
Not Found
@endif