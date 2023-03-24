<?php

namespace Morningtrain\WP\Logger;

use Morningtrain\WP\Logger\Classes\Log;
use Morningtrain\WP\Logger\Loggers\FileLogger;
use Morningtrain\WP\Logger\Loggers\RayLogger;
use Psr\Log\LoggerInterface;

class Logger
{
    public static array $loggers = [];

    public static function log(): Log
    {
        return new Log(static::$loggers);
    }

    public static function fileLogger(string $path): FileLogger
    {
        return new FileLogger($path);
    }

    public static function rayLogger(bool $backtrace = false): RayLogger
    {
        return new RayLogger($backtrace);
    }

    public static function registerLoggers(array $loggers): void
    {
        foreach ($loggers as $logger) {
            static::registerLogger($logger);
        }
    }

    public static function registerLogger(LoggerInterface $logger): void
    {
        static::$loggers[] = $logger;
    }
}