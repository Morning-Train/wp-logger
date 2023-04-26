<?php

namespace Morningtrain\WP\Logger\Loggers;

use Illuminate\Support\Facades\Date;
use Morningtrain\WP\Logger\Abstracts\AbstractLeveledLogger;
use Morningtrain\WP\Logger\Models\DbLogger as DbLoggerModel;

class DbLogger extends AbstractLeveledLogger
{
    public function __construct()
    {
    }

    public function log($level, $message, array $context = []): void
    {
        // Remove first two backtraces, so it's the correct spot that where the logger was called
        $debugBacktrace = debug_backtrace();
        $debugBacktrace = array_splice($debugBacktrace, 2);

        DbLoggerModel::query()
            ->insert([
                'error_level' => $level,
                'error_message' => $message,
                'error_context' => json_encode($context),
                'error_backtrace' => json_encode($debugBacktrace),
                'created_at' => Date::now(),
            ]);
    }
}