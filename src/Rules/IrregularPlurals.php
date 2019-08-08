<?php
/**
 * pluralize.
 * Author: Artur Rychcik (artur.rychcik@gmail.com)
 * 07.08.2019, 17:56
 */

namespace plejus\PhpPluralize\Rules;

/**
 * Class IrregularPlurals
 *
 * @package plejus\PhpPluralize\Rules
 */
class IrregularPlurals
{
    /**
     * @return array
     */
    public static function getAll()
    {
        return [
            // Pronouns.
            ['I', 'we'],
            ['me', 'us'],
            ['he', 'they'],
            ['she', 'they'],
            ['them', 'them'],
            ['myself', 'ourselves'],
            ['yourself', 'yourselves'],
            ['itself', 'themselves'],
            ['herself', 'themselves'],
            ['himself', 'themselves'],
            ['themself', 'themselves'],
            ['is', 'are'],
            ['was', 'were'],
            ['has', 'have'],
            ['this', 'these'],
            ['that', 'those'],
            // Words ending in with a consonant and `o`.
            ['echo', 'echoes'],
            ['dingo', 'dingoes'],
            ['volcano', 'volcanoes'],
            ['tornado', 'tornadoes'],
            ['torpedo', 'torpedoes'],
            // Ends with `us`.
            ['genus', 'genera'],
            ['viscus', 'viscera'],
            // Ends with `ma`.
            ['stigma', 'stigmata'],
            ['stoma', 'stomata'],
            ['dogma', 'dogmata'],
            ['lemma', 'lemmata'],
            ['schema', 'schemata'],
            ['anathema', 'anathemata'],
            // Other irregular rules.
            ['ox', 'oxen'],
            ['axe', 'axes'],
            ['die', 'dice'],
            ['yes', 'yeses'],
            ['foot', 'feet'],
            ['eave', 'eaves'],
            ['goose', 'geese'],
            ['tooth', 'teeth'],
            ['quiz', 'quizzes'],
            ['human', 'humans'],
            ['proof', 'proofs'],
            ['carve', 'carves'],
            ['valve', 'valves'],
            ['looey', 'looies'],
            ['thief', 'thieves'],
            ['groove', 'grooves'],
            ['pickaxe', 'pickaxes'],
            ['passerby', 'passersby'],
            ['cookie', 'cookies'],
        ];
    }
}
