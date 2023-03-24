<?php

namespace Morningtrain\WP\Logger\Loggers;

use Morningtrain\WP\Logger\Abstracts\AbstractLeveledLogger;

class FileLogger extends AbstractLeveledLogger
{
    private string $path;

    public function __construct(
        string $path
    )
    {
        $this->path = rtrim($path, '/\\') . '/';
        $this->path .= date('Y') . '/';
        $this->path .= date('m');
    }

    public function log($level, $message, array $context = []): void
    {
        if (! file_exists($this->path)) {
            mkdir($this->path, 0777, true);
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

        $filename = $this->path . '/' . date('d') . '.txt';

        file_put_contents($filename, $logContent, FILE_APPEND);
    }
}