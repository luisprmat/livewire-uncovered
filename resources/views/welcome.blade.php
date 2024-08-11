<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire Uncovered</title>
    <link rel="stylesheet" href="/app.css">
</head>
<body>
    @livewire(App\Livewire\Counter::class)

    <script src="/app.js"></script>

    <script>
        // wire all elements with wire:snapshot
        document.querySelectorAll('[wire\\:snapshot]').forEach(el => {
            let snapshot = JSON.parse(el.getAttribute('wire:snapshot'))
            console.log(snapshot)
        })
        // go through each, pull of the string of data
        // turn that string into an actual javascript object
        // ...
    </script>
</body>
</html>
