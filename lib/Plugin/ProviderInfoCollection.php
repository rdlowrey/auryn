<?php


namespace Auryn\Plugin;


class ProviderInfoCollection {

    /**
     * @var ProviderInfo[]
     */
    protected $providerInfoArray = array();

    function __construct($value, array $chainClassConstructors) {
        $this->addInfo($value, $chainClassConstructors);
    }

    /** Sets a value to use when the specified chainClassConstructors match the
     * chainClassConstructors from the classes being created.
     * @param $value
     * @param array $chainClassConstructors
     */
    function addInfo($value, array $chainClassConstructors) {
        $this->providerInfoArray[] = new ProviderInfo($value, $chainClassConstructors);
    }

    /**
     * Get the providerInfo from the best matched providerInfoArray entry based on
     * how well the chainClassConstructors match.
     *
     * Example
     * -------
     * The chainClassConstructors that the Injector is contructing is
     * ['PageController', 'DBConnection', 'Logger']
     *
     * The scores for various ProviderInfo entries held by this collection
     * would be:
     *
     * ['PageController', 'DBConnection', 'Logger'] => 3 - all 3 elements match
     * ['PageController', 'Logger'] => 2 - Two elements match
     * ['DBConnection', 'Logger'] => 2 - Two elements match
     * ['EmailController', 'DBConnection', 'Logger'] => -1 - First element doesn't match,
     * so matching fails.
     * * ['DBConnection' 'PageController', 'Logger'] => -1 - elements are out of order,
     * and so matching would fail.
     *
     *
     * @param array $chainClassConstructors
     * @param bool $isSet
     * @return ProviderInfo|null The best matching providerInfo or null if none matched.
     */
    function getBestMatchingInfo(array $chainClassConstructors, &$isSet = false) {
        $bestMatchingInfo = null;

        $bestMatch = -1;
        foreach ($this->providerInfoArray as $injectionInfo) {
            if ($injectionInfo->sumMatchingChainClassConstructors($chainClassConstructors) > $bestMatch){
                $bestMatchingInfo = $injectionInfo;
            }
        }

        if ($bestMatchingInfo == null) {
            return null;
        }

        $isSet = true;

        return $bestMatchingInfo;
    }

    /**
     * @param array $chainClassConstructors
     * @return ProviderInfo|null
     */
    function getExactMatchingInfo(array $chainClassConstructors) {
        $requiredScore = count($chainClassConstructors);

        foreach ($this->providerInfoArray as $injectionInfo) {
            $compareScore = $injectionInfo->sumMatchingChainClassConstructors($chainClassConstructors);
            if ($compareScore == $requiredScore) {
                return $injectionInfo;
            }
        }

        return null;
    }
}




 