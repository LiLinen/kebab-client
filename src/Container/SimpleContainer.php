<?php declare(strict_types = 1);

namespace App\Container;

class SimpleContainer
{
    private $dependencies = [];

    public function set(string $key, $value): self
    {
        $this->dependencies[$key] = $value;

        return $this;
    }

    public function get(string $key)
    {
        return $this->dependencies[$key];
    }
}
