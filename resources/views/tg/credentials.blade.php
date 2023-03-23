@if (count($credentials))
@foreach ($credentials as $credential)
{{ $credential->name }}

@foreach ($credential->credentials as $item)
{!! $item !!}
@endforeach

=================================================

@endforeach
@else
Not Found
@endif