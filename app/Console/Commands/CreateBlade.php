<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateBlade extends Command
{
    protected $signature = 'app:create-blade {name}';

    protected $description = 'Command description';

    public function handle()
    {
        $name = $this->argument('name');
        $indexPath = resource_path("views/backend/{$name}/index.blade.php");
        $editPath = resource_path("views/backend/{$name}/edit.blade.php");
        $createPath = resource_path("views/backend/{$name}/create.blade.php");

        $copyFrom = resource_path('views/backend/products/create.blade.php');


        if (! is_dir(resource_path("views/backend/{$name}"))) {
            mkdir(resource_path("views/backend/{$name}"), 0755, true);
        }
        if (! file_exists($indexPath)) {
            file_put_contents($indexPath, file_get_contents($copyFrom));
        }
        if (! file_exists($editPath)) {
            file_put_contents($editPath, '');
        }
        if (! file_exists($createPath)) {
            file_put_contents($createPath, '');
        }
    }
}
