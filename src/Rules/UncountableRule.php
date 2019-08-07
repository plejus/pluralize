<?php
/**
 * pluralize.
 * Author: Artur Rychcik (artur.rychcik@gmail.com)
 * 07.08.2019, 18:05
 */

namespace plejus\PhpPluralize\Rules;

class UncountableRule
{
    public static function getAll()
    {
        return   [
                // Singular words with no plurals.
                'adulthood',
                'advice',
                'agenda',
                'aid',
                'aircraft',
                'alcohol',
                'ammo',
                'analytics',
                'anime',
                'athletics',
                'audio',
                'bison',
                'blood',
                'bream',
                'buffalo',
                'butter',
                'carp',
                'cash',
                'chassis',
                'chess',
                'clothing',
                'cod',
                'commerce',
                'cooperation',
                'corps',
                'debris',
                'diabetes',
                'digestion',
                'elk',
                'energy',
                'equipment',
                'excretion',
                'expertise',
                'firmware',
                'flounder',
                'fun',
                'gallows',
                'garbage',
                'graffiti',
                'hardware',
                'headquarters',
                'health',
                'herpes',
                'highjinks',
                'homework',
                'housework',
                'information',
                'jeans',
                'justice',
                'kudos',
                'labour',
                'literature',
                'machinery',
                'mackerel',
                'mail',
                'media',
                'mews',
                'moose',
                'music',
                'mud',
                'manga',
                'news',
                'only',
                'personnel',
                'pike',
                'plankton',
                'pliers',
                'police',
                'pollution',
                'premises',
                'rain',
                'research',
                'rice',
                'salmon',
                'scissors',
                'series',
                'sewage',
                'shambles',
                'shrimp',
                'software',
                'species',
                'staff',
                'swine',
                'tennis',
                'thanks',
                'traffic',
                'transportation',
                'trout',
                'tuna',
                'wealth',
                'welfare',
                'whiting',
                'wildebeest',
                'wildlife',
                'you',
                '/pok[eé]mon$/i',
                '/[^aeiou]ese$/i', // "chinese", "japanese"
                '/deer$/i', // "deer", "reindeer"
                '/fish$/i', // "fish", "blowfish", "angelfish"
                '/measles$/i',
                '/o[iu]s$/i', // "carnivorous"
                '/pox$/i', // "chickpox", "smallpox"
                '/sheep$/i'
              ];
    }
}
