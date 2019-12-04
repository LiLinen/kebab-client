<?php declare(strict_types = 1);

namespace App\Container;

class SmartContainer
{
    private $dependencies = [];

    public function set(string $key, $value): self
    {
        $this->dependencies[$key] = $value;

        return $this;
    }

    public function get(string $key)
    {
        $value = $this->dependencies[$key];

        if (is_callable($value)) {
            $function = $value;

            return $function($this);
        }

        return $value;
    }
}
