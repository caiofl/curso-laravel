<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Pegar o titulo dinamico do .env-->
    <title>@yield('title') - {{ config('app.name') }} </title>
</head>
<body>
    
    <div class="content">
        @yield('content')
    </div>

</body>
</html>