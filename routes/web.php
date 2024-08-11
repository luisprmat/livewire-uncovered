<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::post('livewire', function () {
    dd(request('callMethod'));
    dd(request('snapshot'));

    return request()->all();
});

Blade::directive('livewire', function ($expression) {
    return "<?php echo (new App\Livewire)->initialRender({$expression}); ?>";
});
