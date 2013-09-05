<?php

namespace Auryn;

class CyclicDependencyException extends InjectionException {

	private $classThatDetectedCycle;

	function __construct($cycleDetector, $message = '', $code = 0, $prev = NULL) {
		parent::__construct($message, $code, $prev);
		$this->classThatDetectedCycle = $cycleDetector;
	}

	function getCycleDetector() {
		return $this->classThatDetectedCycle;
	}

}