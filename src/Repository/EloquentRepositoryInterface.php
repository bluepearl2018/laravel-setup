<?php

namespace Eutranet\Setup\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @laravel-commons Eutranet\Commons\Repository\Interface
 */
interface EloquentRepositoryInterface
{
    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;
}
