<?php

namespace Verona\Component\Console\Command;

abstract class AbstractCommand {
    abstract function start(array $arguments = []);
}