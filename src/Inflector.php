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

/**
 * Class Inflector
 *
 * @package plejus\PhpPluralize
 */
class Inflector
{
    /** @var array  */
    private $irregularSingles = [];

    /** @var array  */
    private $irregularPlurals = [];

    /** @var array  */
    private $pluralRules      = [];

    /** @var array  */
    private $singularRules    = [];

    /** @var RuleAplicator  */
    private $aplicator;

    /**
     * Inflector constructor.
     */
    public function __construct()
    {
        $this->pluralRules     = PluralizationRule::getAll();
        $this->singularRules   = SingularizationRule::getAll();
        $this->aplicator       = new RuleAplicator();

        foreach (IrregularPlurals::getAll() as $rule) {
            $this->irregularSingles[$rule[0]] = $rule[1];
            $this->irregularPlurals[$rule[1]] = $rule[0];
        }

        foreach (UncountableRule::getAll() as $rule) {
            $this->addUncountableRule($rule);
        }
    }

    /**
     * @param      $text
     * @param      $count
     * @param bool $includeCount
     *
     * @return string
     */
    public function pluralize($text, $count, $includeCount = false)
    {
        return ($includeCount ? $count . " " : "")
            . (intval($count) === 1
                ? $this->singular($text)
                : $this->plural($text)
            );
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function plural($text)
    {
        $callback = $this->aplicator->replaceWord(
            $this->irregularSingles,
            $this->irregularPlurals,
            $this->pluralRules
        );

        return $callback($text);
    }

    /**
     * @param string $text
     *
     * @return bool
     */
    public function isPlural($text)
    {
        $callback = $this->aplicator->checkWord(
            $this->irregularSingles,
            $this->irregularPlurals,
            $this->pluralRules
        );

        return $callback($text);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function singular($text)
    {
        $callback = $this->aplicator->replaceWord(
            $this->irregularPlurals,
            $this->irregularSingles,
            $this->singularRules
        );

        return $callback($text);
    }

    /**
     * @param string $text
     *
     * @return bool
     */
    public function isSingular($text)
    {
        $callback = $this->aplicator->checkWord(
            $this->irregularPlurals,
            $this->irregularSingles,
            $this->singularRules
        );

        return $callback($text);
    }

    /**
     * @see \plejus\PhpPluralize\Rules\PluralizationRule
     *
     * @param string $rule        Regex string to find
     * @param string $replacement Replacement with regex match
     */
    public function addPluralRule($rule, $replacement)
    {
        $this->pluralRules[] = [$rule, $replacement];
    }

    /**
     * @see \plejus\PhpPluralize\Rules\SingularizationRule
     *
     * @param string $rule        Regex string to find
     * @param string $replacement Replacement with regex match
     */
    public function addSingularRule($rule, $replacement)
    {
        $this->singularRules[] = [$rule, $replacement];
    }

    /**
     * @param string $single
     * @param string $plural
     */
    public function addIrregularRule($single, $plural)
    {
        $this->irregularSingles[$single] = strtolower($plural);
        $this->irregularPlurals[$plural] = strtolower($single);
    }

    /**
     * @param string $rule Uncountable word or Regex string
     */
    public function addUncountableRule($rule)
    {
        if (substr($rule, 0, 1) === '/') {
            $this->pluralRules[]   = [$rule, '$0'];
            $this->singularRules[] = [$rule, '$0'];
        } else {
            $this->aplicator->addUncountableWord($rule);
        }
    }
}
