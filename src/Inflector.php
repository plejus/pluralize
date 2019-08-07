<?php
/**
 * (c) Author: Artur Rychcik (artur.rychcik@gmail.com)
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace plejus\PhpPluralize;

class Inflector
{
    public function pluralize($text, $occurences = 2)
    {
        return $text;
    }

    public function singular($text)
    {
        return $text;
    }

    public function isSingular($text)
    {
        return false;
    }

    public function isPlural($text)
    {
        return false;
    }
}
