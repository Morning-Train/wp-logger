<?php

namespace Morningtrain\WP\Logger\Abstracts;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use ReflectionClass;

abstract class AbstractLeveledLogger extends AbstractLogger
{
    protected array $levels = [];

    public function registerAllLevels(): static
    {
        $logLevels = new ReflectionClass(LogLevel::class);

        return $this->registerLevels($logLevels->getConstants());
    }

    public function registerLevels(array $levels): static
    {
        foreach ($levels as $level) {
            $this->registerLevel($level);
        }

        return $this;
    }

    public function registerLevel(string $level): static
    {
        $this->levels[$level] = $level;

        return $this;
    }

    public function shallApplyOnLevel(string $level): bool
    {
        return isset($this->levels[$level]);
    }
}