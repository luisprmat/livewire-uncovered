<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return <<<'HTML'
            <div class="counter">
                <span>{{ $count }}</span>

                <button wire:click="increment">+</button>
            </div>
        HTML;
    }
}
