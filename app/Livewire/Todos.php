<?php

namespace App\Livewire;

class Todos
{
    public $draft = 'Alguna tarea ...';

    public $todos;

    public function mount()
    {
        $this->todos = collect(['Tarea 1', 'Tarea 2']);
    }

    public function addTodo()
    {
        $this->todos->push($this->draft);

        $this->draft = '';
    }

    public function render()
    {
        return <<<'HTML'
            <div class="todos">
                <input type="text" wire:model="draft">

                <button wire:click="addTodo">Agregar tarea</button>

                <ul>
                    @foreach($todos as $todo)
                        <li>{{ $todo }}</li>
                    @endforeach
                </ul>
            </div>
        HTML;
    }
}
