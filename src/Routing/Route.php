<?php

namespace Verona\Component\Routing;

use Attribute;

#[Attribute]
final class Route
{
    public function __construct(public string $path, public string $name, public ?string $controller = null) {}
}
