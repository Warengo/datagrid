<?php declare(strict_types = 1);

namespace Warengo\DataGrid\Columns;

use Nette\Utils\Html;
use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Row;
use Warengo\Datagrid\Promises\PromiseContainer;
use WebChemistry\Images\IImageStorage;
use WebChemistry\Images\Resources\IResource;

class ImageColumn extends Column {

	/** @var PromiseContainer */
	private $promiseContainer;

	/** @var IImageStorage */
	private $imageStorage;

	/** @var string */
	private $alias;

	public function __construct(DataGrid $grid, string $key, string $column, string $name, PromiseContainer $promiseContainer) {
		parent::__construct($grid, $key, $column, $name);

		$this->promiseContainer = $promiseContainer;
	}

	/**
	 * @param string $alias
	 */
	public function setAlias(string $alias): void {
		$this->alias = $alias;
	}

	protected function getImageStorage(): IImageStorage {
		if (!$this->imageStorage) {
			$this->imageStorage = $this->promiseContainer->getContainer()->getByType(IImageStorage::class);
		}

		return $this->imageStorage;
	}

	public function render(Row $row) {
		/** @var IResource $resource */
		if ($resource = $this->getColumnValue($row)) {
			if ($this->alias) {
				$resource->setAliases([$this->alias]);
			}

			return Html::el('img', [
				'src' => $this->getImageStorage()->link($resource),
				'class' => 'grid-column-image',
			]);
		} else {
			return '';
		}
	}

}
