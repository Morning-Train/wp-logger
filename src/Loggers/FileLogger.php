<?php

namespace Morningtrain\WP\Logger\Loggers;

use Morningtrain\WP\Logger\Abstracts\AbstractLeveledLogger;

class FileLogger extends AbstractLeveledLogger {

    public function log($level, \Stringable|string $message, array $context = []): void
    {

    }
}