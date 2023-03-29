<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="icon" type="image" href="{{ asset('images/samson.png') }}">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Profile | Settings</title>

</head>
<body class="h-screen w-screen overflow-hidden font-poppins">
    {{-- loading screen --}}
    <div class="bg-white/80 w-full h-screen absolute z-50 flex" id="loadingScreen">
        <div class="w-[500px] h-[300px] flex flex-col items-center justify-center m-auto space-y-5">
            <span class="material-symbols-outlined text-5xl text-sky-500  animate-spin">
                cached
            </span>
            <span class="text-2xl tracking-widest text-sky-500 font-bold animate-pulse">LOADING...</span>
        </div>
    </div>

    <main class="h-full select-none bg-white flex">
        <x-sidebar_settings/>
        @yield('content')
    </main>

    <script>

        var loader = document.getElementById('loadingScreen');
        window.addEventListener("load", function(){
            loader.style.display = "none";
        });

    </script>
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    @yield('scripts')

</body>
</html>
