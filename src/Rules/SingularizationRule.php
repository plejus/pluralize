<?php
/**
 * pluralize.
 * Author: Artur Rychcik (artur.rychcik@gmail.com)
 * 07.08.2019, 18:04
 */

namespace plejus\PhpPluralize\Rules;

class SingularizationRule
{
    public static function getAll()
    {
        return [
            ['/s$/i', ''],
            ['/(ss)$/i', '$1'],
            ['/(wi|kni|(?:after|half|high|low|mid|non|night|[^\w]|^)li)ves$/i', '$1fe'],
            ['/(ar|(?:wo|[ae])l|[eo][ao])ves$/i', '$1f'],
            ['/ies$/i', 'y'],
            ['/\b([pl]|zomb|(?:neck|cross)?t|coll|faer|food|gen|goon|group|lass|talk|goal|cut)ies$/i', '$1ie'],
            ['/\b(mon|smil)ies$/i', '$1ey'],
            ['/\b((?:tit)?m|l)ice$/i', '$1ouse'],
            ['/(seraph|cherub)im$/i', '$1'],
            ['/(x|ch|ss|sh|zz|tto|go|cho|alias|[^aou]us|t[lm]as|gas|(?:her|at|gr)o|[aeiou]ris)(?:es)?$/i', '$1'],
            ['/(analy|diagno|parenthe|progno|synop|the|empha|cri|ne)(?:sis|ses)$/i', '$1sis'],
            ['/(movie|twelve|abuse|e[mn]u)s$/i', '$1'],
            ['/(test)(?:is|es)$/i', '$1is'],
            ['/(alumn|syllab|vir|radi|nucle|fung|cact|stimul|termin|bacill|foc|uter|loc|strat)(?:us|i)$/i', '$1us'],
            ['/(agend|addend|millenni|dat|extrem|bacteri|desiderat|strat|candelabr|errat|ov|symposi|curricul|quor)a$/i', '$1um'],
            ['/(apheli|hyperbat|periheli|asyndet|noumen|phenomen|criteri|organ|prolegomen|hedr|automat)a$/i', '$1on'],
            ['/(alumn|alg|vertebr)ae$/i', '$1a'],
            ['/(cod|mur|sil|vert|ind)ices$/i', '$1ex'],
            ['/(matr|append)ices$/i', '$1ix'],
            ['/(pe)(rson|ople)$/i', '$1rson'],
            ['/(child)ren$/i', '$1'],
            ['/(eau)x?$/i', '$1'],
            ['/men$/i', 'man']
        ];
    }
}
