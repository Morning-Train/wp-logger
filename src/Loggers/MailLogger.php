<?php

namespace Morningtrain\WP\Logger\Loggers;

use Morningtrain\WP\Logger\Abstracts\AbstractLeveledLogger;

class MailLogger extends AbstractLeveledLogger
{
    public function __construct(private array $emails)
    {
    }

    public function log($level, $message, array $context = []): void
    {
        wp_mail(
            $this->emails,
            "There was an error - Error type: {$level}",
            print_r([
                'Message' => $message,
                'Context' => $context,
            ], true),
        );
    }
}