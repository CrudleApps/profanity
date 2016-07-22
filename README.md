# Profanity - A PHP Profanity Filter

It's important to note that, while this was fun to put together, profanity filters will likely never work the way we all need them to.
Profanity relies almost entirely on context; for example, "bitch" can easily refer to a female dog. "Dick" could refer to Richard.

However, there are some words that are bad no matter the context. This package tries to remedy the situations where you need to
safe guard against naughty words (e.g. in forums where young children frequent)

# Installation

There are no other dependencies for this package so run the below and you're good to go.

```
composer require crudleapps/profanity
```

# Usage

The filter requires at least one `Dictionary` to function. This package comes with a GB and US dictionary out of the box.

```php
use Crudle\Profanity\Filter;
use Crudle\Profanity\Dictionary\GB;

$filter = new Filter(new GB);

// Clean a string
$filter->cleanse('Joe is a little bitch'); // Returns 'Joe is a little *****'

// Clean a string with a custom censor character
$filter->cleanse('Joe is a little bitch', 'x'); // Returns 'Joe is a little xxxxx'

// Check if a string is dirty
$filter->isDirty('Joe is a little bitch'); // Returns true
```

# Dictionaries

It is entirely possible that the dictionaries included in this package are either too strict or not strict
enough for your use. That's no problem. You can easily create your own dictionary by extending `Crudle\Profanity\Dictionary\AbstractDictionary`

All you need to include is a protected `$badWords` member with your array of words. For example:

```php
class MyDictionary extends AbstractDictionary
{
    protected $badWords = [
        'bollocks',
        'twat'
    ];
}

$filter = new Filter(new MyDictionary);
```

There is another way if you dislike extending someone elses code. You can simply pass your own array of words to any
dictionaries `add` method.

```php
$dictionary = new GB();
$dictionary->add(['dicks', 'bitches']);

// Alternatively, clear the existing words in the dictionary if you want to start fresh
$dictionary->clear();
$dictionary->add(['ho', 'testicle']);
```