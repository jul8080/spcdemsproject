<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image" href="{{ asset('images/samson.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Web | Scanner</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="h-screen w-screen overflow-y-hidden bg-slate-200">
    <div id="app" class="h-full">
        <scanner-component data="{{ $data }}" time="{{ Carbon\Carbon::parse($todayTime)->format('h:i A') }}"></scanner-component>
    </div>
</body>

</html>