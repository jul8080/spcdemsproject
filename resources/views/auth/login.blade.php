<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="icon" type="image" href="{{ asset('images/samson.png') }}"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    @vite('resources/css/app.css')
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <title>Welcome | login</title>
</head>
<body class="bg-white h-screen w-full flex flex-col relative overflow-hidden">


    <div class="m-auto bg-gray-100 w-[400px] h-[450px] rounded-sm flex-col relative shadow py-3 hidden">

        <img src="{{ asset('images/samson.png') }}" class="h-52 w-52 absolute m-auto left-0 right-0 -top-16">
        {{-- <img src="{{ asset('images/samson.png') }}" class="h-52 w-52 absolute m-auto inset-0"> --}}

        <div class="flex-1 px-10 flex justify-end items-end">
            <form action="{{ route('check.attemp') }}" method="POST" class="h-[280px] w-full flex flex-col gap-2">
                @csrf
                    {{-- email input  --}}

                <div class="bg-gray-100 w-full h-12 before:block before:absolute before:bg-[#00B0F0] before:h-full before:w-1 before:left-0 relative mt-7">
                    <input type="email" placeholder="Email" class="outline-none w-full pl-3 h-full bg-gray-100 caret-sky-500 focus:ring-1 focus:ring-[#00B0F0]" name="email">
                </div>
                <span class="text-xs text-red-500 font-semibold">@error('email') {{ $message }} @enderror</span>

                    {{-- password input  --}}

                <div class="bg-gray-100 w-full h-12 before:block before:absolute before:bg-[#00B0F0] before:h-full before:w-1 before:left-0 relative">
                    <input type="password" placeholder="Password" class="outline-none w-full pl-3 h-full bg-gray-100 caret-sky-500 focus:ring-1 focus:ring-[#00B0F0]"" name="password" >
                </div>
                <span class="text-xs text-red-500 font-semibold">@error('password') {{ $message }} @enderror</span>

                    {{-- remember me checked box --}}

                <div class="bg-gray-100 w-full h-12 flex items-center gap-1 group">
                    <input type="checkbox" name="rememberme" id="rememberme" class="h-4 w-4  bg-[#8FAADC] cursor-pointer">
                    <label for="rememberme" class="text-sm font-semibold text-[#00B0F0] group-hover:cursor-pointer">Remember me</label>
                </div>

                    {{-- button submit  --}}

                <div class="bg-gray-100 w-full h-12 flex items-center gap-1">
                    <button type="submit" class="btn btn-success transition rounded-md">sign in</button>
                </div>

            </form>
        </div>

    </div>

        {{-- employee login form tablet version--}}


        {{-- ************************employee login form desktop & laptop version*************************** --}}

    <div class="m-auto w-[900px] h-[500px] rounded-md flex login-container-shadow">
        <div class="bg-gray-50 flex-1 flex items-center justify-center flex-col p-10">
            <div class=" w-full h-full">
                <img src="{{ asset('images/logo-trans-1.png') }}" class="h-full w-full object-cover">
            </div>
        </div>
        <div class="flex-1 flex flex-col justify-center items-center bg-white relative">
            <div class="bg-sky-400 w-[370px] h-[80px] absolute top-10 rounded-md flex items-center justify-center">
                <span class="capitalize text-white font-bold text-2xl">login your account</span>
            </div>
            {{-- error message  --}}
            <div class="w-full flex items-center justify-center h-10 absolute top-36">
                @if (Session::get('message'))
                <span class="text-sm font-semibold text-red-400">{{ Session::get('message') }}</span>
                @endif
            </div>

            <form action="{{ route('check.attemp') }}" method="POST" class="h-[280px] w-full flex flex-col gap-2 px-10 mt-36">
                @csrf

                <div class="bg-gray-100 w-full h-12 before:block before:absolute before:bg-[#00B0F0] before:h-full before:w-1 before:left-0 relative mt-7">
                    <input type="email" name="email" class="outline-none w-full pl-3 h-full bg-gray-100 caret-sky-500 focus:ring-1 focus:ring-[#00B0F0]" placeholder="Email" @if (Cookie::has('emailCookie')) value="{{ Cookie::get('emailCookie') }}" @endif >
                </div>
                <span class="text-xs text-red-500 font-semibold">@error('email') {{ $message }} @enderror</span>

                <div class="bg-gray-100 w-full h-12 before:block before:absolute before:bg-[#00B0F0] before:h-full before:w-1 before:left-0 relative">
                    <input type="password" name="password" class="outline-none w-full pl-3 h-full bg-gray-100 caret-sky-500 focus:ring-1 focus:ring-[#00B0F0]" placeholder="Password" @if (Cookie::has('pwdCookie')) value="{{ Cookie::get('pwdCookie') }}" @endif >
                </div>
                <span class="text-xs text-red-500 font-semibold">@error('password') {{ $message }} @enderror</span>


                <div class="w-full flex items-center group">
                    <input type="checkbox" name="rememberme" id="rememberme" class="h-4 w-4  bg-[#8FAADC] cursor-pointer"
                     @if (Cookie::has('emailCookie'))
                        checked
                     @endif>
                    <label for="rememberme" class="text-sm font-semibold text-[#00B0F0] group-hover:cursor-pointer ml-2">Remember me</label>
                </div>
                <div class="w-full h-16 flex items-center">
                    <button type="submit" class="btn btn-success transition rounded-md">sign in</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#attemp-fail').animate({
            'bottom': '1.75rem'
        }, 'fast');

        setTimeout(() => {
            $('#attemp-fail').animate({
                'bottom': '-1000'
            });
        }, 10000);

        $('#close').click(function () {
            $('#attemp-fail').animate({
                'bottom': '-1000'
            });
         });
    </script>
</body>
</html>
