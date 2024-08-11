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
        document.querySelectorAll('[wire\\:snapshot]').forEach(el => {
            let snapshot = JSON.parse(el.getAttribute('wire:snapshot'))

            el.addEventListener('click', e => {
                if(!e.target.hasAttribute('wire:click')) return

                let method = e.target.getAttribute('wire:click')

                fetch('/livewire', {
                    method: 'POST',
                    headers: { 'Content-Type' : 'application/json' },
                    body: JSON.stringify({
                        snapshot,
                        callMethod: method,
                    })
                })
            })
        })
    </script>
</body>
</html>
