<?php

namespace App;

use Illuminate\Support\Facades\Blade;
use ReflectionClass;
use ReflectionProperty;

class Livewire
{
    public function initialRender($class)
    {
        $component = new $class;

        return Blade::render(
            $component->render(),
            $this->getProperties($component)
        );
    }

    public function getProperties($component)
    {
        $properties = [];

        $reflectedProperties = (new ReflectionClass($component))->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($reflectedProperties as $property) {
            $properties[$property->getName()] = $property->getValue($component);
        }

        return $properties;
    }
}
