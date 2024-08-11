<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Blade::directive('livewire', function ($expression) {
    return "<?php echo (new App\Livewire)->initialRender({$expression}); ?>";
});
