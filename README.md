# WP Logger

Make it easier to handle different levels of log.


## Table of Contents

- [Introduction](#introduction)
- [Getting Started](#getting-started)
  - [Installation](#installation)
- [Dependencies](#dependencies)
- [Usage](#usage)
  - [Initializing package](#initializing-package)
  - [Use package](#use-package)
- [Contributing](#contributing)
- [Contributors](#contributors)
- [License](#license)


## Introduction

Make it easier to handle different levels of log.


## Getting Started

To get started install the package as described below in [Installation](#installation).

To use the tool have a look at [Usage](#usage)


### Installation

Install with composer

```bash
composer require morningtrain/wp-logger
```


## Dependencies

- [psr/log](https://packagist.org/packages/psr/log)


## Usage

### Initializing package

First of all, to get `\Morningtrain\WP\Logger\Loggers\DatabaseLogger` to work, the migration needs to be run. This is done be running the following method:  

```php
\Morningtrain\WP\Logger\Logger::initializeMigration()
```

Initialize `\Morningtrain\WP\Logger\Logger` with a slug and an array of the loggers that needs to be registered.  
For each logger, there is some levels, that can be registered for the specific logger.

```php
\Morningtrain\WP\Logger\Logger::registerLoggers(
    'logger', 
    [
        // Loggers
    ]
);
```

#### Loggers
Each logger has the following methods, to register what level(s) that is needed:  
- `->registerLevel($level)`
- `->registerLevels([$level])`
- `->registerAllLevels()`

##### _Database Logger_  
Make it possible to save logs to the database.  
Class: `\Morningtrain\WP\Logger\Loggers\DatabaseLogger`

```php
\Morningtrain\WP\Logger\Logger::databaseLogger()
```

##### _File Logger_  
Make it possible to save logs to a file.  
Class: `\Morningtrain\WP\Logger\Loggers\FileLogger`
Parameters in callback:
- `string $filename`

```php
\Morningtrain\WP\Logger\Logger::fileLogger($filename)
```

##### _Mail Logger_  
Make it possible to send logs to multiple emails.  
Class: `\Morningtrain\WP\Logger\Loggers\MailLogger`
Parameters in callback:
- `array $emails`

```php
\Morningtrain\WP\Logger\Logger::mailLogger($emails)
```

##### _Ray Logger_
Make it possible to send logs to a Ray client.  
Class: `\Morningtrain\WP\Logger\Loggers\RayLogger`
Parameters in callback:
- `bool $backtrace // Optional. If true, it will add backtrace`

```php
\Morningtrain\WP\Logger\Logger::rayLogger()
```

#### Levels
```php
\Psr\Log\LogLevel::EMERGENCY
\Psr\Log\LogLevel::ALERT
\Psr\Log\LogLevel::CRITICAL
\Psr\Log\LogLevel::ERROR
\Psr\Log\LogLevel::WARNING
\Psr\Log\LogLevel::NOTICE
\Psr\Log\LogLevel::INFO
\Psr\Log\LogLevel::DEBUG
```

### Use package

To get the Logger, that has been registered, the method `\Morningtrain\WP\Logger\Logger::getLogger($slug)`, where the slug is needed.  
When the logger is collected, there is a method, for each level, that can be call:

```php
\Morningtrain\WP\Logger\Logger::getLogger('logger')
    ->emergency()
    ->alert()
    ->critical()
    ->error()
    ->warning()
    ->notice()
    ->info()
    ->debug()
```

Each of these methods that:
- `string $message`
- `array $context // Optional`


## Contributing

Thank you for your interest in contributing to the project.


### Bug Report

If you found a bug, we encourage you to make a pull request.

To add a bug report, create a new issue. Please remember to add a telling title, detailed description and how to reproduce the problem.


### Support Questions

We do not provide support for this package.


### Pull Requests

1. Fork the Project
2. Create your Feature Branch (git checkout -b feature/AmazingFeature)
3. Commit your Changes (git commit -m 'Add some AmazingFeature')
4. Push to the Branch (git push origin feature/AmazingFeature)
5. Open a Pull Request


## Contributors

- [Martin Schadegg Brønniche](https://github.com/mschadegg)
- [Mathias Bærentsen](https://github.com/matbaek)
- [All Contributors](../../contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.


---

<div align="center">
Developed by <br>
</div>
<br>
<div align="center">
<a href="https://morningtrain.dk" target="_blank">
<img src="https://morningtrain.dk/wp-content/themes/mtt-wordpress-theme/assets/img/logo-only-text.svg" width="200" alt="Morningtrain logo">
</a>
</div>
