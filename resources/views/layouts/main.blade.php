<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- <link rel="icon" type="image" href="{{ asset('images/samson.png') }}"> -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!-- @vite('resources/css/app.css') -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Employee Management Sysytem</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="h-screen w-screen overflow-y-hidden font-poppins">

        <main class="h-full select-none bg-white flex" id="app">
            <div class="bg-white desktop:w-[300px] laptop:w-[200px] h-full flex-shrink-0 shadow">
                <x-sidebar />
            </div>
            @yield('content')
        </main>

    <!-- <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script> -->
    @yield('scripts')

</body>
</html>
