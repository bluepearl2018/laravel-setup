<?php

namespace Eutranet\Setup\Console\Commands;

use Eutranet\Init\Console\Commands\InstallPackageCommand;

class EutranetInstallSetupCommand extends InstallPackageCommand
{
    public function __construct()
    {
        $this->signature = 'eutranet:install-setup';
        parent::__construct('setup', $this->signature);
    }
}
