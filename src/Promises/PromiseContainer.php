<?php declare(strict_types = 1);

namespace Warengo\Datagrid\Promises;

use Nette\DI\Container;

final class PromiseContainer {

	/** @var Container */
	private $container;
	
	public function attach(Container $container): void {
		$this->container = $container;
	}

	public function getContainer(): Container {
		if (!$this->container) {
			throw new PromiseException(Container::class . ' is not filled.');
		}
		return $this->container;
	}
	
}
