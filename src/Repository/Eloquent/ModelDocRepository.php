<?php

namespace Eutranet\Setup\Repository\Eloquent;

use Eutranet\Setup\Repository\BaseRepository;
use JetBrains\PhpStorm\Pure;
use Eutranet\Setup\Models\ModelDoc;
use Eutranet\Setup\Repository\Interface\EutranetSetupInterface;

class ModelDocRepository extends BaseRepository implements EutranetSetupInterface
{
    /**
     * Gneral termr Repository constructor..
     *
     * @param ModelDoc $model
     */

    #[Pure] public function __construct(ModelDoc $model)
    {
        parent::__construct($model);
    }
}
