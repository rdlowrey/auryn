<?php


namespace Auryn\Plugin;


/**
 * Class ProviderInfo - Holds information to be used by the
 * ClassConstructorChainProviderPlugin which allows the Plugin to then
 * select the most appropriate value.
 * @package Auryn\Plugin
 */
class ProviderInfo {

    /** @var $value - The information being stored. */
    private $information;
    
    /** @var array - The chain of class constructors that the information held should
     * be applied to. */
    private $chainClassConstructors;

    function __construct($info, array $chainClassConstructors) {
        $this->information = $info;
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

    function setInformation($value) {
        $this->information = $value;
    }

    function getInformation() {
        return $this->information;
    }

    function getChainClassConstructors() {
        return $this->chainClassConstructors;
    }
}




 