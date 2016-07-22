<?php

namespace Crudle\Profanity;

use Crudle\Profanity\Dictionary\GB;
use Crudle\Profanity\Dictionary\US;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Filter
     */
    private $filter;

    public function setUp()
    {
        $this->filter = new Filter(new GB);
    }

    public function tearDown()
    {
        unset($this->filter);
    }

    public function test_bad_words_existing_in_dictionary_are_censored()
    {
        $this->assertEquals('****', $this->filter->cleanse('fuck'));
        $this->assertEquals('Joe can **** himself the *******', $this->filter->cleanse('Joe can fuck himself the bastard'));
        $this->assertEquals('trololoXXXX', $this->filter->cleanse('trololoshit', 'X'));
    }

    public function test_filter_can_return_instance_of_dictionary()
    {
        $this->assertInstanceOf(Dictionary::class, $this->filter->getDictionary());
    }

    public function test_dictionaries_can_include_other_dictionaries()
    {
        $this->filter->getDictionary()->include([new US]);
        
        $this->assertEquals('******', $this->filter->cleanse('honkey'));
    }

    public function test_clean_words_remain_untouched()
    {
        $this->assertEquals('hello world', $this->filter->cleanse('hello world'));
    }

    public function test_filter_can_check_if_a_string_is_dirty()
    {
        $this->assertTrue($this->filter->isDirty('oh fuck this shit'));
        $this->assertFalse($this->filter->isDirty('i\'m a good boy'));
    }

    public function test_dictionary_can_be_cleared()
    {
        $this->assertEmpty($this->filter->getDictionary()->clear()->get());
    }

    public function test_developer_can_append_words_to_dictionary()
    {
        $this->filter->getDictionary()->add(['knobgobbler']);
        $this->assertEquals('***********', $this->filter->cleanse('knobgobbler'));
        $this->assertEquals('****', $this->filter->cleanse('fuck'));
    }
}
