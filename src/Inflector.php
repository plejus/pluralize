<?php
/**
 * (c) Author: Artur Rychcik (artur.rychcik@gmail.com)
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace plejus\PhpPluralize;

use plejus\PhpPluralize\Rules\IrregularPlurals;
use plejus\PhpPluralize\Rules\PluralizationRule;
use plejus\PhpPluralize\Rules\SingularizationRule;
use plejus\PhpPluralize\Rules\UncountableRule;

class Inflector
{
    private $irregularSingles = [];
    private $irregularPlurals = [];
    private $pluralRules      = [];
    private $singularRules    = [];
    private $uncountables     = [];

    public function __construct()
    {
        $this->pluralRules[]   = PluralizationRule::getAll();
        $this->singularRules[] = SingularizationRule::getAll();

        foreach (IrregularPlurals::getAll() as $rule) {
            $this->irregularSingles[$rule[0]] = $rule[1];
            $this->irregularPlurals[$rule[1]] = $rule[0];
        }

        foreach (UncountableRule::getAll() as $rule) {
            if (substr($rule, 0, 1) === '/') {
                $this->pluralRules[]   = [$rule, '$0'];
                $this->singularRules[] = [$rule, '$0'];
            } else {
                $this->uncountables[] = $rule;
            }
        }
    }

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

    /**
     * @param $word
     * @param $token
     *
     * @return string
     */
    private function restoreCase($word, $token)
    {
        // Tokens are an exact match.
        if ($word === $token) {
            return $token;
        }

        // Lower cased words. E.g. "hello".
        if ($word === strtolower($word)) {
            return strtolower($token);
        }

        // Upper cased words. E.g. "WHISKY".
        if ($word === strtoupper($word)) {
            return strtoupper($token);
        }

        // Title cased words. E.g. "Title".
        if ($word === ucfirst($word)) {
            return ucfirst($token);
        }

        // Lower cased words. E.g. "test".
        return strtolower($token);
    }
    
    private function interpolate($str, $args)
    {
        return preg_replace('/\$(\d{1,2})/g', $args, $str);
    }
}
