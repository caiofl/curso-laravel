<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Pegar o titulo dinamico do .env-->
    <title>@yield('title') - {{ config('app.name') }} </title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50">
    
    <div class="container mx-auto py-8">
        @yield('content')
    </div>

</body>
</html>