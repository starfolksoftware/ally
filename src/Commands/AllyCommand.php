<?php

namespace StarfolkSoftware\Ally\Commands;

use Illuminate\Console\Command;

class AllyCommand extends Command
{
    public $signature = 'ally';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
