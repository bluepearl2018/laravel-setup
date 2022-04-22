<?php

namespace Eutranet\Setup\Repository;

use Illuminate\Database\Eloquent\Model;
use Schema;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements EloquentRepositoryInterface
{
	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository constructor.
	 *
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * @return Collection
	 */
	public function all(): Collection
	{
		return $this->model->all();
	}

	/**
	 * @param array $attributes
	 *
	 * @return Model
	 */
	public function create(array $attributes): Model
	{
		return $this->model->create($attributes);
	}

	/**
	 * @param $id
	 * @return Model|null
	 */
	public function find($id): ?Model
	{
		return $this->model->find($id);
	}

	/**
	 * @param string $tableName
	 * @return bool
	 */
	public function tableIsEmpty($tableName): bool
	{
		return $this->tableExists($tableName) && $this->model->count() < 1;
	}

	/**
	 * @param string $tableName
	 * @return bool
	 */
	public function tableExists($tableName): bool
	{
		return Schema::hasTable($tableName);
	}
}
