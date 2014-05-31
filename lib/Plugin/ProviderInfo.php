<?php


namespace Auryn\Plugin;


/**
 * Class ProviderInfo - Holds information to be used by the
 * ClassConstructorChainProviderPlugin which allows the Plugin to then
 * select the most appropriate value.
 * @package Auryn\Plugin
 */
class ProviderInfo {

    private $value;
    private $chainClassConstructors;

    function __construct($value, array $chainClassConstructors) {
        $this->value = $value;
        $this->chainClassConstructors = $chainClassConstructors;
    }

    /**
     * Calculates a score for how well the required chainClassConstructors for
     * this class matches the chainClassConstructors param.
     *
     * @param array $chainClassConstructors
     * @return int Returns the total of how many elements match, or -1 if they do
     * not match.
     */
    function sumMatchingChainClassConstructors(array $chainClassConstructors) {

        $usedIndex = 0;
        $score = 0;

        foreach ($this->chainClassConstructors as $className) {
            $found = false;

            for ($x = $usedIndex; $x<count($chainClassConstructors) ; $x++) {
                if (strcasecmp($chainClassConstructors[$x], $className) === 0) {
                    $usedIndex = $x;
                    $score += 1;
                    $found = true;
                }
            }
            if ($found == false) {
                //The required classname was not found in the class hierarchy.
                return -1;
            }
        }

        return $score;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function getValue() {
        return $this->value;
    }

    function getChainClassConstructors() {
        return $this->chainClassConstructors;
    }
}




 