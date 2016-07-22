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

interface Dictionary
{
    /**
     * Retrieve the list of naughty words
     * @return string[]
     */
    public function get(): array;

    /**
     * Include any number of other dictionaries
     * @param Dictionary[] $dictionaries
     * @return Dictionary
     */
    public function include(array $dictionaries): Dictionary;

    /**
     * Append your own bad words to the dictionary, preserving what was already there
     * @param string[] $badWords
     * @return Dictionary
     */
    public function add(array $badWords): Dictionary;

    /**
     * Clear the dictionary of bad words
     * @return Dictionary
     */
    public function clear(): Dictionary;
}