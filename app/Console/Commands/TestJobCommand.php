<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class TestJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Job';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        dispatch(new TestJob());
    }
}
