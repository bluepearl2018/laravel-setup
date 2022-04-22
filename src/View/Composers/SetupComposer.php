<?php

namespace Eutranet\Setup\View\Composers;

use Illuminate\View\View;
use Eutranet\Setup\Repository\Eloquent\SetupProcessRepository;
use Eutranet\Setup\Repository\Eloquent\SetupStepRepository;

class SetupComposer
{

	private SetupProcessRepository $setupProcessRepo;
	private SetupStepRepository $setupStepRepo;

	public function __construct(
		SetupProcessRepository $setupProcessRepository,
		SetupStepRepository    $setupStepRepository)
	{
		$this->setupProcessRepo = $setupProcessRepository;
		$this->setupStepRepo = $setupStepRepository;
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
			->with('setupSteps', $this->setupStepRepo->all())
			->with('setupIsComplete', $this->setupProcessRepo->isComplete(1));
	}
}