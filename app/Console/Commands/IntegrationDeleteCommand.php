<?php

namespace App\Console\Commands;

use App\Models\Integration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class IntegrationDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:integration {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command delete integration.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $validator = Validator::make($this->options(), [
            'id' => 'required|exists:integrations,id',
        ]);
        if ($validator->fails())
        {
            return 0;
        }
        Integration::query()
            ->where('id', $this->option('id'))
            ->delete();

        $this->info('The command was successful!');

        return 1;
    }
}
