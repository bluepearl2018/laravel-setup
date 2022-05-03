<?php

namespace Eutranet\Setup\Repository\Interface;

use Illuminate\Database\Eloquent\Model;
use Eutranet\Setup\Repository\EloquentRepositoryInterface;

/**
 * Interface EutranetSetupInterface
 * @laravel-setup Eutranet\Setup\RepositoryInterface
 */
interface EutranetSetupInterface extends EloquentRepositoryInterface
{
    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model;
}
