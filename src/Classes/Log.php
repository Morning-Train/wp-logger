<?php

namespace Morningtrain\WP\Logger\Classes;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class Log extends AbstractLogger
{
    public function __construct(private array $loggers)
    {
    }

    public function log($level, $message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel($level) as $logger) {
            $logger->log($level, $message, $context);
        }
    }

    /**
     * System is unusable.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel(LogLevel::EMERGENCY) as $logger) {
            $logger->emergency($message, $context);
        }
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel(LogLevel::ALERT) as $logger) {
            $logger->alert($message, $context);
        }
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel(LogLevel::CRITICAL) as $logger) {
            $logger->critical($message, $context);
        }
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel(LogLevel::ERROR) as $logger) {
            $logger->error($message, $context);
        }
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel(LogLevel::WARNING) as $logger) {
            $logger->warning($message, $context);
        }
    }

    /**
     * Normal but significant events.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel(LogLevel::NOTICE) as $logger) {
            $logger->notice($message, $context);
        }
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel(LogLevel::INFO) as $logger) {
            $logger->info($message, $context);
        }
    }

    /**
     * Detailed debug information.
     *
     * @param string|\Stringable $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = []): void
    {
        foreach ($this->getLoggersForLevel(LogLevel::DEBUG) as $logger) {
            $logger->debug($message, $context);
        }
    }

    protected function getLoggersForLevel(string $level): array
    {
        return array_filter(
            $this->loggers, function ($logger) use ($level) {
            // If the logger does not have info about which levels it should apply to, then we just use it
            if (!method_exists($logger, 'shallApplyOnLevel')) {
                return true;
            }

            return $logger->shallApplyOnLevel($level);
        }
        );
    }
}