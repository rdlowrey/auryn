<?php

namespace Auryn\Test;

use PHPUnit\Framework\TestCase;

/**
 * Convert a string with printf format specifiers to regexp patterns.
 *
 * Does not support width or precision flags.
 *
 * @param string $string A string that would be used as template for sprintf
 * @return string The string converted to a regexp
 */
function templateStringToRegExp(string $string): string
{
    $string = preg_quote($string, '#');

    $replacements = [
        // a string of characters
        '%s' => '.*',   // strings can be empty, so *
        // decimal (integer) number (base 10)
        '%d' => '[+-]?\d+',  // numbers can't be empty so +

        // character
        '%c' => '[\s\S]',

        // todo
        // exponential floating-point number
        // %e

        // floating-point number
        '%f' => "[+-]?([0-9]*[.])?[0-9]+",

        // integer (base 10)
        '%i' => '[+-]?\d+',

        // octal number (base 8)
        '%o' => "[+-]?([0-7])+",

        // unsigned decimal (integer) number
        '%u' => '[0-9][0-9]*',

        // number in hexadecimal (base 16)
        '%x' =>  '[[:xdigit:]]+'
    ];

    $string = str_replace(
        array_keys($replacements),
        array_values($replacements),
        $string
    );

    return '#' . $string . '#iu';
}

abstract class BaseTest extends TestCase
{
    /**
     * @param string $templateString A template string for printf e.g. "Hello %s"
     * @param string $actualString The string to test to see if it matches e.g. "Hello John"
     */
    public function assertStringMatchesTemplateString(string $templateString, string $actualString): void
    {
        $regExp = templateStringToRegExp($templateString);
        $this->assertMatchesRegularExpression($regExp, $actualString);
    }

    /**
     * @param string $templateString A template string for printf e.g. "Hello %s"
     */
    public function expectExceptionMessageMatchesTemplateString(string $templateString): void
    {
        $regexp = templateStringToRegExp($templateString);
        $this->expectExceptionMessageMatches($regexp);
    }

    /**
     * @param string $text The string to look for.
     * @param string $flags The regexp flags to use.
     */
    public function expectExceptionMessageContains(string $text, string $flags = 'iu'): void
    {
        $regexp = '/' . preg_quote($text, '/') . '/' . $flags;
        $this->expectExceptionMessageMatches($regexp);
    }
}