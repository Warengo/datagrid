<?php declare(strict_types = 1);

namespace Warengo\DataGrid\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Definition;
use Nette\DI\Definitions\FactoryDefinition;
use Warengo\DataGrid\BaseGrid;
use Warengo\DataGrid\DataGrid;
use Warengo\DataGrid\Factories\IGridFactory;
use WebChemistry\Decorator\Decorator;

final class DataGridExtension extends CompilerExtension {

	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();

		$builder->addFactoryDefinition($this->prefix('factory'))
			->setImplement(IGridFactory::class)
			->getResultDefinition()
				->setType(DataGrid::class);
	}

	public function beforeCompile() {
		$decorator = new Decorator($this->getContainerBuilder());

		$decorator->decorate(BaseGrid::class)
			->addSetup('injectComponents');
	}

	private function findByType(string $type): array {
		return array_filter($this->getContainerBuilder()->getDefinitions(), function (Definition $def) use ($type): bool {
			return is_a($def->getType(), $type, true)
				|| ($def instanceof FactoryDefinition&& is_a($def->getResultType(), $type, true));
		});
	}

}
