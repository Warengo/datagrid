<?php declare(strict_types = 1);

namespace Warengo\DataGrid\Columns;

use Nette\Utils\Html;
use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\Row;

class BooleanColumn extends Column {

	public function render(Row $row) {
		if ($this->getColumnValue($row)) {
			return Html::el('i')->setAttribute('class', 'ti-check text-success');
		} else {
			return Html::el('i')->setAttribute('class', 'ti-close text-danger');
		}
	}

	public function getAlign() {
		return 'center';
	}

}
