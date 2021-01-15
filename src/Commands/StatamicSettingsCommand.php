<?php

namespace Edalzell\StatamicSettings\Commands;

use Illuminate\Console\Command;

class StatamicSettingsCommand extends Command
{
    public $signature = 'statamic-settings';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
