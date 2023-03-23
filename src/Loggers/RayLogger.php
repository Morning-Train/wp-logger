<?php

namespace Morningtrain\WP\Logger\Loggers;

use Morningtrain\WP\Logger\Abstracts\AbstractLeveledLogger;

class RayLogger extends AbstractLeveledLogger {

    public function __construct()
    {
        if(!function_exists('ray')) {
            return;
        }

        ray()->separator();
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        if(!function_exists('ray')) {
            return;
        }

        ray($message)->label($level);

        if(!empty($context)) {
            ray()->table($context, "{$level} - context");
        }
    }
}