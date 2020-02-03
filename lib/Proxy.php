<?php
declare(strict_types=1);

namespace Auryn;

use ProxyManager\Factory\AbstractBaseFactory as BaseProxy;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;

/**
 * Class Proxy
 * @package Auryn
 */
class Proxy implements ProxyInterface
{
	/**
	 * @var BaseProxy
	 */
	private $proxy_manager;

	public function __construct(BaseProxy $proxy = null)
	{
		$this->proxy_manager = $proxy ?? new LazyLoadingValueHolderFactory();
	}

	/**
	 * @inheritDoc
	 */
	public function createProxy(string $className, \Closure $callback): object {
		return $this->proxy_manager->createProxy(
			$className,
			function (
				&$wrappedObject,
				$proxy,
				$method,
				$parameters,
				&$initializer
			) use ($callback) {
				$wrappedObject = $callback();
				$initializer = null;
			}
		);
	}
}