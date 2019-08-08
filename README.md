# PHP Pluralize / Singularize Package
Pluralize and Singularize any English word. You can also check if word is in plural or singular form.

Module contains list of irregular and uncountable rules. You can also add your custom rules.

## Installation

```bash
composer require plejus/pluralize
```

## Usage

```php
<?php

use plejus\PhpPluralize\Inflector;

$inflector = new Inflector();

$output = $inflector->plural("dog");
// output: "dogs"

$output = $inflector->singular("dogs");
// output: "dog"

$output = $inflector->isPlural("dogs");
// output: true

$output = $inflector->isSingular("dogs");
// output: false

$inflector->addIrregularRule('something', 'some things');
$output = $inflector->plural("something");
// output: "some things"


$inflector->addSingularRule('/singles$/i', 'singular');
$output = $inflector->singular("singles");
// output: "singular

```

## Real Life Examples

#### Group some animal forum tags to help user find content

```php
<?php

use plejus\PhpPluralize\Inflector;

$tags      = [
    100 => "dog",
    101 => "parrot",
    102 => "dogs",
    103 => "monkeys",
    104 => "cats",
    105 => "cat",
    106 => "doggies",
];

$inflector = new Inflector();
$inflector->addSingularRule('/doggies$/i', 'dog');

$groups = [];

foreach ($tags as $id => $tag) {
    $correctTag = $inflector->isSingular($tag)
        ? $tag
        : $inflector->singular($tag);

    if (!array_key_exists($correctTag, $groups)) {
        $groups[$correctTag] = [];
    }

    $groups[$correctTag][] = $id;
}

/*
 * Output:
 * 
 * Array
    (
        [dog] => Array
            (
                [0] => 100
                [1] => 102
                [2] => 106
            )
    
        [parrot] => Array
            (
                [0] => 101
            )
    
        [monkey] => Array
            (
                [0] => 103
            )
    
        [cat] => Array
            (
                [0] => 104
                [1] => 105
            )
    )
 */
```

#### Display correct form of word

```php
<?php

use plejus\PhpPluralize\Inflector;

$inflector = new Inflector();

for ($i = 1; $i <= 3; $i++) {
    echo "I have $i " . $inflector->pluralize("apple", $i);
}

/*
*  Output:
*  "I have 1 apple"
*  "I have 2 apples"
*  "I have 3 apples"
*/
```

## License

MIT
