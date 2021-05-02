<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

</head>
<body>
<ul>
    @foreach($mineList as $mine)
        <li>{{$mine['name']}}</li>
    @endforeach

</ul>

</body>
</html>
