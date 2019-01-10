<?php declare(strict_types = 1);

namespace Warengo\DataGrid;

use Ublaboo\DataGrid\Components\DataGridPaginator\DataGridPaginator;
use Warengo\DataGrid\Columns\BooleanColumn;

class DataGrid extends \Ublaboo\DataGrid\DataGrid {

	public function addColumnBoolean(string $key, string $name, ?string $column = null): BooleanColumn {
		$this->addColumnCheck($key);
		$column = $column ?: $key;

		return $this->addColumn($key, new BooleanColumn($this, $key, $column, $name));
	}

	public function addEditAction(string $link) {
		$this->addAction('edit', 'upravit', $link)
			->setClass('btn btn-primary btn-sm');
	}

	public function addDeleteAction(callable $callback) {
		$this->addActionCallback('delete', 'odstranit', function ($id) use ($callback) {
			$id = (int) $id;
			if (!$id) {
				$this->redirect('this');
			}
			$callback($id);

			$this->getPresenter()->flashMessage('Položka odstraněna.');
			$this->redirect('this');
		})
			->setConfirm('Jste si opravdu jistí?')
			->setClass('btn btn-danger btn-sm');
	}

	public function addLinkAction(string $key, string $name, string $address) {
		$this->addAction($key, $name, $address)
			->addAttributes(['target' => '_blank'])
			->setClass('btn btn-primary btn-sm');
	}

	public function addColumnNumber($key, $name, $column = null) {
		$column = parent::addColumnNumber($key, $name, $column);
		$column->setAlign('left');

		return $column;
	}

	/**
	 * Paginator factory
	 */
	public function createComponentPaginator() {
		/**
		 * Init paginator
		 */
		$component = new DataGridPaginator(
			$this->getTranslator(),
			static::$icon_prefix
		);
		$paginator = $component->getPaginator();

		$paginator->setPage($this->page);
		if ($this->getPerPage() !== 'all') {
			$paginator->setItemsPerPage((int) $this->getPerPage());
		}

		return $component;
	}

}
