@if (count($sites))
@foreach ($sites as $site)

/sites@ {{ $site->name }}

{{ $site->url }}

=================================================

@endforeach
@else
Not Found
@endif