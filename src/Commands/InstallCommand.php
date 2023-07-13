<?php

namespace Ally\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $signature = 'ally:install';

    public $description = 'Install the Ally package and resources';

    public function handle(): int
    {
        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'ally-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'ally-migrations', '--force' => true]);

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/Contact.php', app_path('Models/Contact.php'));

        // Service Providers...
        copy(__DIR__.'/../../stubs/app/Providers/AllyServiceProvider.php', app_path('Providers/AllyServiceProvider.php'));

        $this->installServiceProviderAfter('RouteServiceProvider', 'AllyServiceProvider');

        return self::SUCCESS;
    }

    /**
     * Install the service provider in the application configuration file.
     *
     * @param  string  $after
     * @param  string  $name
     * @return void
     */
    protected function installServiceProviderAfter($after, $name)
    {
        if (! Str::contains($appConfig = file_get_contents(config_path('app.php')), 'App\\Providers\\'.$name.'::class')) {
            file_put_contents(config_path('app.php'), str_replace(
                'App\\Providers\\'.$after.'::class,',
                'App\\Providers\\'.$after.'::class,'.PHP_EOL.'        App\\Providers\\'.$name.'::class,',
                $appConfig
            ));
        }
    }
}
