<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Title</title>

    @livewireStyles
    @vite(['resources/css/app.css'])
</head>
<body>
@vite(['resources/js/app.js'])
<div class="container">
   {{$slot}}
</div>
@livewireScripts
</body>
</html>
