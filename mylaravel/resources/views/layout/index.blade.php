<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
<div>
    <div style="background: #abcdef;width: 100%;height: 100px;">1</div>
    @section('content')
        <div style="background: #bceded;width: 400%;height: 400px;">2</div>
    @show
    @section('footer')
        <div style="background: #ccddee;width: 100%;height: 100px;">3</div>
    @show
    @section('js')
    @show
</div>
</body>
</html>
