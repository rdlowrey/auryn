<?php
declare(strict_types=1);

namespace Auryn;

/**
 * Interface ProxyInterface
 * @package Auryn
 */
interface ProxyInterface
{
	/**
	 * @param string $className
	 * @param \Closure $callback
	 * @return object
	 */
	public function createProxy(string $className, \Closure $callback): object;

}