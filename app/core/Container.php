<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class Container
{
    /**
     * @var array<string, callable(self): object>
     */
    private array $bindings = [];

    /**
     * Register a service.
     */
    public function bind(string $id, callable $factory): void
    {
        $this->bindings[$id] = $factory;
    }

    /**
     * Resolve a service.
     */
    public function get(string $id): object
    {
        if (!isset($this->bindings[$id])) {
            throw new RuntimeException("Service '{$id}' has not been registered.");
        }

        return ($this->bindings[$id])($this);
    }
}