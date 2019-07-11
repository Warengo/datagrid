<?php declare(strict_types = 1);

namespace Warengo\DataGrid;

use Nette\SmartObject;
use Warengo\DataGrid\Factories\IGridFactory;

abstract class BaseGrid {

	use SmartObject;

	/** @var IGridFactory */
	private $gridFactory;

	final public function injectComponents(IGridFactory $gridFactory): void {
		$this->gridFactory = $gridFactory;
	}

	protected function createGrid() {
		return $this->gridFactory->create();
	}

}
