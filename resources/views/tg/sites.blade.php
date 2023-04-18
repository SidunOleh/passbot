@if (count($sites))
@foreach ($sites as $site)
{{ $site->name }}
https://t.me/sova_pass_bot?sites={{ $site->name }}

{{ $site->url }}

=================================================

@endforeach
@else
Not Found
@endif