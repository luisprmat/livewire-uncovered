<?php

namespace App\Livewire;

class Todos
{
    public function render()
    {
        return <<<'HTML'
            <div class="todos">
                <input type="text">

                <button>Agregar tarea</button>

                <ul>
                    <li>Tarea 1</li>
                    <li>Tarea 2</li>
                </ul>
            </div>
        HTML;
    }
}
