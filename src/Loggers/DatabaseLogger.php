<?php

namespace Morningtrain\WP\Logger\Loggers;

use Morningtrain\WP\Logger\Abstracts\AbstractLeveledLogger;
use Morningtrain\WP\Logger\Models\DatabaseLogger as DatabaseLoggerModel;

class DatabaseLogger extends AbstractLeveledLogger
{
    public function __construct()
    {
    }

    public function log($level, $message, array $context = []): void
    {
        // Remove logger package backtraces, so it's the correct spot that where the logger was called
        $lastItem = null;
        $debugBacktrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 15);
        foreach ($debugBacktrace as $key => $item) {
            if (! str_starts_with($item['class'], 'Morningtrain\WP\Logger') && ! str_starts_with($item['class'], 'Psr\Log\AbstractLogger')) {
                break;
            }

            $lastItem = $debugBacktrace[$key];
            unset($debugBacktrace[$key]);
        }
        $debugBacktrace = array_splice($debugBacktrace, 0, 10);

        DatabaseLoggerModel::query()
            ->insert([
                'error_level' => $level,
                'error_message' => $message,
                'error_context' => json_encode($context),
                'error_backtrace' => json_encode($debugBacktrace),
                'error_file' => $lastItem['file'] . ':' . $lastItem['line'],
                'created_at' => current_time('mysql'),
            ]);
    }
}