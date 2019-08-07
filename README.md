# PHP Pluralize / Singularize Package
Pluralize and Singularize any English word. You can also check if word is in plural or singular form.

## Installation

```bash
composer require plejus/pluralize
```

## Usage

```php
<?php

use plejus\PhpPluralize\Inflector;

$inflector = new Inflector();

$output = $inflector->pluralize("dog");
// output: "dogs"

$output = $inflector->singular("dogs");
// output: "dog"

$output = $inflector->isPlural("dogs");
// output: true

$output = $inflector->isSingular("dogs");
// output: false
```

## License

MIT
