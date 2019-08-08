<?php
/**
 * pluralize.
 * Author: Artur Rychcik (artur.rychcik@gmail.com)
 * 08.08.2019, 12:15
 */

namespace plejus\PhpPluralize;

/**
 * Class RuleAplicator
 *
 * @package plejus\PhpPluralize
 */
class RuleAplicator
{
    /** @var array */
    private $uncountables;

    /**
     * RuleAplicator constructor.
     *
     * @param array $uncountables Array of words that should stay unchanged
     */
    public function __construct($uncountables = [])
    {
        $this->uncountables = $uncountables;
    }

    /**
     * @param string $word
     */
    public function addUncountableWord($word)
    {
        $this->uncountables[] = $word;
    }

    /**
     * @param array $replaceMap
     * @param array $keepMap
     * @param array $rules
     *
     * @return \Closure
     */
    public function replaceWord($replaceMap, $keepMap, $rules)
    {
        return function ($word) use ($replaceMap, $keepMap, $rules) {
            $token = strtolower($word);

            if (array_key_exists($token, $keepMap)) {
                return $this->restoreCase($word, $token);
            }

            if (array_key_exists($token, $replaceMap)) {
                return $this->restoreCase($word, $replaceMap[$token]);
            }

            return $this->sanitizeWord($token, $word, $rules);
        };
    }

    /**
     * Check if a word is part of the map.
     * @param array $replaceMap
     * @param array $keepMap
     * @param array $rules
     *
     * @return \Closure
     */
    public function checkWord($replaceMap, $keepMap, $rules)
    {
        return function ($word) use ($replaceMap, $keepMap, $rules) {
            $token = strtolower($word);

            if (array_key_exists($token, $keepMap)) {
                return true;
            }

            if (array_key_exists($token, $replaceMap)) {
                return false;
            }

            return $this->sanitizeWord($token, $word, $rules) === $token;
        };
    }

    /**
     * @param string $word
     * @param string $token
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

    /**
     * @param string $str
     * @param array  $args
     *
     * @return string
     */
    private function interpolate($str, $args)
    {
        return preg_replace_callback('/\$(\d{1,2})/', function ($matches) use ($args) {
            return isset($matches[1], $args[$matches[1]])
                ? $args[$matches[1]]
                : "";
        }, $str);
    }

    /**
     * @param string $word
     * @param array  $rule
     *
     * @return string
     */
    private function replace($word, $rule)
    {
        return preg_replace_callback($rule[0], function ($matches) use ($word, $rule) {
            if (!isset($matches[0])) {
                return $word;
            }

            $result = $this->interpolate($rule[1], $matches);

            if ($matches[0] === '' && isset($matches[1])) {
                $sub = substr($word, $matches[1] - 1);
                return $this->restoreCase($sub, $result);
            }

            return $this->restoreCase($matches[0], $result);
        }, $word);
    }

    /**
     * @param string $token
     * @param string $word
     * @param array  $rules
     *
     * @return string
     */
    private function sanitizeWord($token, $word, $rules)
    {
        if (empty($token) || array_key_exists($token, $this->uncountables)) {
            return $word;
        }

        $len = count($rules);

        while ($len--) {
            $rule = $rules[$len];

            if (preg_match($rule[0], $word)) {
                return $this->replace($word, $rule);
            }
        }

        return $word;
    }
}
