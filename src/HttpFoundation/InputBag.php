<?php

namespace Verona\Component\HttpFoundation;

final class InputBag {

    public function __construct(private array $query)
    {
    }

    public function get(string $key, mixed $default = null) : object {
        return in_array($key, array_keys($this->query)) ? trim($this->query[$key]) : $default;
    }

    public function getString(string $key, string $default = "") : string {
        return (string) $this->get($key, $default);
    }

    public function getInt(string $key, int $default = -1) : int {
        return (int) $this->get($key, $default);
    }

}