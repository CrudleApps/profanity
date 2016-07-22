<?php

/**
 * This file is part of the core PHP package for crudleapps/profanity.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package crudleapps/profanity
 * @author Nathan King <nathan@crudle.co.uk>
 */

namespace Crudle\Profanity;

class Filter
{
    /**
     * @var Dictionary
     */
    private $dictionary;

    /**
     * Filter constructor
     * @param Dictionary $dictionary
     */
    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * Cleanse a string of any profanity defined in your dictionaries
     * @param string $string
     * @param string $censor
     * @return string
     */
    public function cleanse(string $string, string $censor = '*'): string
    {
        if (strlen($censor) > 1) {
            $censor = substr($censor, 0, 1);
        }

        foreach ($this->dictionary->get() as $naughtyWord) {
            if (substr_count($string, $naughtyWord) > 0) {
                $replacement = '';
                for ($i = 0; $i < strlen($naughtyWord); $i++) {
                    $replacement .= $censor;
                }

                $string = str_replace($naughtyWord, $replacement, $string);
            }
        }

        return $string;
    }

    /**
     * Check if a string contains naughty words
     * @param string $string
     * @return bool
     */
    public function isDirty(string $string): bool
    {
        foreach ($this->dictionary->get() as $naughtyWord) {
            if (substr_count($string, $naughtyWord) > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Dictionary
     */
    public function getDictionary(): Dictionary
    {
        return $this->dictionary;
    }
}