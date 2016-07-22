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

namespace Crudle\Profanity\Dictionary;

use Crudle\Profanity\Dictionary;

class AbstractDictionary implements Dictionary
{
    /**
     * @var string[]
     */
    protected $badWords = [];

    /**
     * Retrieve the list of naughty words
     * @return string[]
     */
    public function get(): array
    {
        return $this->badWords;
    }

    /**
     * Include any number of other dictionaries
     * @param Dictionary[] $dictionaries
     * @return Dictionary
     */
    public function include(array $dictionaries): Dictionary
    {
        foreach ($dictionaries as $dictionary) {
            $this->badWords = array_merge($this->badWords, $dictionary->get());
        }

        return $this;
    }

    /**
     * Append your own bad words to the dictionary, preserving what was already there
     * @param string[] $badWords
     * @return Dictionary
     */
    public function add(array $badWords): Dictionary
    {
        $this->badWords = array_merge($this->badWords, $badWords);

        return $this;
    }

    /**
     * Clear the dictionary of bad words
     * @return Dictionary
     */
    public function clear(): Dictionary
    {
        $this->badWords = [];

        return $this;
    }
}