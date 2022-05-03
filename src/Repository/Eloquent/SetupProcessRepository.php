<?php

namespace Eutranet\Setup\Repository\Eloquent;

use Eutranet\Setup\Repository\BaseRepository;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use Eutranet\Setup\Models\SetupProcess;
use Eutranet\Setup\Repository\Interface\EutranetSetupInterface;

/**
 *
 */
class SetupProcessRepository extends BaseRepository implements EutranetSetupInterface
{
    /**
     * Setup Process Repository constructor.
     *
     * @param SetupProcess $model
     */

    #[Pure] public function __construct(SetupProcess $model)
    {
        parent::__construct($model);
    }

    /**
     * ---------------------------------------------------
     * CHECKS
     * ---------------------------------------------------
     */

    /**
     * @param $model
     * @return bool
     */
    public function isComplete($model): bool
    {
        return $this->model->is_complete === true;
    }

    /**
     * ---------------------------------------------------
     * ACTIONS
     * ---------------------------------------------------
     */

    /**
     * @param $model
     * @return void
     */
    public function setComplete($model)
    {
        $this->model->update(['is_complete' => true]);
    }
}
