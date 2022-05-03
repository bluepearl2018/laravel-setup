<?php

namespace Eutranet\Setup\View\Composers;

use Eutranet\Setup\Repository\Eloquent\SetupProcessRepository;
use Illuminate\View\View;
use Eutranet\Setup\Models\SetupStep;
use Schema;

class ModelDocComposer
{
    private $setupStep;
    // private ModelDocRepository $modelDocRepo;
    private SetupProcessRepository $setupProcessRepo;

    public function __construct(SetupProcessRepository $setupProcessRepository)
    {
        // $this->modelDocRepo = $modelDocRespository;
        $this->setupProcessRepo = $setupProcessRepository;
        if (Schema::hasTable('setup_steps')) {
            $this->setupStep = SetupStep::where('console_action', 'su:seed-model-docs')->get()->first();
        }
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view
            ->with('setupIsComplete', $this->setupProcessRepo->isComplete(1))
            ->with('stepIsComplete', $this->setupStep->is_complete)
            ->with('setupStep', $this->setupStep)
            ->with('restoreDefaultsRoute', 'setup.model-docs.restore-defaults');
    }
}
