<?php

namespace Morningtrain\WP\Logger\Loggers;

use Morningtrain\WP\Logger\Abstracts\AbstractLeveledLogger;

class FileLogger extends AbstractLeveledLogger
{
    public function __construct(private string $filename)
    {
    }

    public function log($level, $message, array $context = []): void
    {
        $parentPath = dirname($this->filename);

        if (! is_dir($parentPath)) {
            mkdir($parentPath, 0660, true);
        }

        $date = current_datetime();

        $logContent = "{$date->format('Y-m-d H:i:s P T')} - {$level}: {$message}";
        $logContent .= PHP_EOL;

        if(!empty($context)) {
            $logContent .= '    [Context]: ';
            $logContent .= str_replace("\n", "\n    ", print_r($context, true));
            $logContent .= PHP_EOL;
        }

        file_put_contents($this->filename, $logContent, FILE_APPEND);
    }
}