@if (count($sites))
@foreach ($sites as $site)
{{ $site->name }}
/sites@{{ $site->name }}

{{ $site->url }}

=================================================

@endforeach
@else
Not Found
@endif