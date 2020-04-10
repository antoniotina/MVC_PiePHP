{{ $user->email }}<br>
{{ $user->id }}<br>
{{ $user->password }}<br>


@foreach ($user->items as $key => $item)
<p>This has a: {$item->name}</p>
@endforeach

{{ $user->email }}<br>
{{ $user->email }}<br>