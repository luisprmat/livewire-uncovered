<?php

namespace App;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionProperty;

class Livewire
{
    public function initialRender($class)
    {
        $component = new $class;

        if (method_exists($component, 'mount')) {
            $component->mount();
        }

        [$html, $snapshot] = $this->toSnapshot($component);

        $snapshotAttribute = htmlentities(json_encode($snapshot));

        return <<<HTML
            <div wire:snapshot="{$snapshotAttribute}">
                {$html}
           </div>
        HTML;
    }

    public function fromSnapshot($snapshot)
    {
        $class = $snapshot['class'];
        $data = $snapshot['data'];

        $component = new $class;

        $this->setProperties($component, $data);

        return $component;
    }

    public function toSnapshot($component)
    {
        $html = Blade::render(
            $component->render(),
            $properties = $this->getProperties($component)
        );

        $snapshot = [
            'class' => get_class($component),
            'data' => $properties,
        ];

        return [$html, $snapshot];
    }

    public function setProperties($component, $properties)
    {
        foreach ($properties as $key => $value) {
            $component->{$key} = $value;
        }
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

    public function callMethod($component, $method)
    {
        $component->{$method}();
    }

    public function updateProperty($component, $property, $value)
    {
        $component->{$property} = $value;

        $updatedHook = 'updated'.Str::title($property);

        if (method_exists($component, $updatedHook)) {
            $component->{$updatedHook}();
        }
    }
}
