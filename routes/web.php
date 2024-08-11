<?php

use App\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::post('livewire', function () {
    // Get a component from snapshot
    $component = (new Livewire)->fromSnapshot(request('snapshot'));

    // Call a method in the component
    if ($method = request('callMethod')) {
        (new Livewire)->callMethod($component, $method);
    }

    [$html, $snapshot] = (new Livewire)->toSnapshot($component);

    // Turn the component back into a snapshot and get the HTML
    return [
        'html' => $html,
        'snapshot' => $snapshot,
    ];
});

Blade::directive('livewire', function ($expression) {
    return "<?php echo (new App\Livewire)->initialRender({$expression}); ?>";
});
