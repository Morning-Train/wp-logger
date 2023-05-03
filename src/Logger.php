<?php

namespace Morningtrain\WP\Logger;

use Morningtrain\WP\Database\Database;
use Morningtrain\WP\Database\Eloquent\Application;
use Morningtrain\WP\Logger\Classes\Log;
use Morningtrain\WP\Logger\Loggers\DatabaseLogger;
use Morningtrain\WP\Logger\Loggers\FileLogger;
use Morningtrain\WP\Logger\Loggers\MailLogger;
use Morningtrain\WP\Logger\Loggers\RayLogger;
use Psr\Log\LoggerInterface;

class Logger
{
    public static array $loggers = [];
    private static bool $databaseInitialized = false;

    public static function initializeMigration(): void
    {
        Database::setup(dirname(__DIR__) . '/database/migrations');
        Database::migrate();
    }

    public static function databaseLogger(): DatabaseLogger
    {
        if (! static::$databaseInitialized) {
            Application::setup();

            static::$databaseInitialized = true;
        }

        return new DatabaseLogger();
    }

    public static function fileLogger(string $filename): FileLogger
    {
        return new FileLogger($filename);
    }

    public static function mailLogger(array $emails): MailLogger
    {
        return new MailLogger($emails);
    }

    public static function rayLogger(bool $backtrace = false): RayLogger
    {
        return new RayLogger($backtrace);
    }

    public static function registerLoggers(string $slug, array $loggersHandlers): void
    {
        if (! empty(static::$loggers[$slug])) {
            $loggersHandlers = array_merge(static::$loggers[$slug], $loggersHandlers);
        }

        static::$loggers[$slug] = new Log($loggersHandlers);
    }

    public static function registerLogger(string $slug, LoggerInterface $loggerHandler): void
    {
        static::registerLoggers($slug, [$loggerHandler]);
    }

    public static function getLogger(string $slug): ?Log
    {
        if (empty(static::$loggers[$slug])) {
            return null;
        }

        return static::$loggers[$slug];
    }
}