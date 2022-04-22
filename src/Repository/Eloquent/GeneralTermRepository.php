<?php

namespace Eutranet\Setup\Repository\Eloquent;

use Eutranet\Setup\Repository\BaseRepository;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use Eutranet\Setup\Models\GeneralTerm;
use Eutranet\Setup\Repository\Interface\EutranetSetupInterface;

class GeneralTermRepository extends BaseRepository implements EutranetSetupInterface
{

	/**
	 * Gneral termr Repository constructor..
	 *
	 * @param GeneralTerm $model
	 */

	#[Pure] public function __construct(GeneralTerm $model)
	{
		parent::__construct($model);
	}

}
