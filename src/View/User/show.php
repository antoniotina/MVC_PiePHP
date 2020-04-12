{{ $user->email }}<br>
{{ $user->id }}  {{ $user->email }}<br>
<p>{$user->password}</p><br>


@foreach ($user->items as $key => $item)
<p>This user has a: {$item->name}</p>
@endforeach

{{ $user->email }}<br>
{{ $user->email }}<br>

<a href='http://localhost/SAMSUNG/SEMESTER2/GITHUB/MVC_PiePHP/user/{$user->id}'>ICI</a>