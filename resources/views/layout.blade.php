<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>GIGAGYM</title>
    
</head>
<body>

    <div id="main" class="w-100 ">
        <div id="topbar" class="bg-slate-400 fixed top-0 w-full flex justify-between p-3">
            <div id="branding" class=" content-center text-white font-bold">
                <h1 class="text-4xl font-bold">GIGAGYM</h1>
            </div>

            <nav id="main-nav " class="flex text-center">
                <a class="bg-blue-300 px-3 py-2 m-1 rounded" href="{{ url('/') }}">Home</a>
                <a class="bg-blue-300 px-3 py-2 m-1 rounded" href="{{ url('/clients') }}">Clients</a>
                <a class="bg-blue-300 px-3 py-2 m-1 rounded" href="{{ url('/logbooks') }}">Logbook</a>
            </nav>
        </div>
        <div id="content" class=" ">
            @yield('content')
        </div>
    </div>

</body>
</html>
