{{ $package->name }}

@foreach ($package->releases as $release)
    {{ $release->version }}
    {{ $release->uri }}
    {{ $release->publish_date }}
    {{ $release->expire_date }}
@endforeach
