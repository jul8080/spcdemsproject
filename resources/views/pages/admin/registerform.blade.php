<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="h-screen w-screen overflow-y-hidden bg-slate-200">
    <div id="app" class="h-full flex justify-center items-center">
        <a href="{{ route('admin.employee') }}">back</a>
        <registerform-component></registerform-component>
    </div>
</body>

</html>