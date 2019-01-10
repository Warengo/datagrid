<?php declare(strict_types = 1);

namespace Warengo\DataGrid\Factories;

use Warengo\DataGrid\DataGrid;

interface IGridFactory {

	public function create(): DataGrid;

}
