<?php

namespace Morningtrain\WP\Logger\Loggers;

use Morningtrain\WP\Logger\Abstracts\AbstractLeveledLogger;

class RayLogger extends AbstractLeveledLogger
{
    public function __construct(private bool $backtrace = false)
    {
    }

    public function log($level, $message, array $context = []): void
    {
        if (! function_exists('ray')) {
            return;
        }

        ray()->separator();

        $values = ['Message' => $message];

        if (! empty($context)) {
            $values['Context'] = $context;
        }

        ray()->table($values, "[{$level}]");

        if ($this->backtrace) {
            ray()->backtrace();
        }

        ray()->separator();
    }
}