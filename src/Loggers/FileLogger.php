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
        if (! file_exists($this->filename)) {
            mkdir($this->filename, 0777, true);
        }

        $logContent = '[DateTime]: ';
        $logContent .= date('Y-m-d H:i:s P T');
        $logContent .= PHP_EOL;

        $logContent .= '[Message]: ';
        $logContent .= $message;
        $logContent .= PHP_EOL;

        $logContent .= '[Context]: ';
        $logContent .= print_r($context, true);
        $logContent .= PHP_EOL;

        file_put_contents($this->filename, $logContent, FILE_APPEND);
    }
}