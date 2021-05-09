<?php

namespace App\Console\Commands;

use App\Models\Integration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class IntegrationCreateCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:integration {--marketplace=} {--username=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command integration create.';

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
     * @return \Illuminate\Support\MessageBag
     * @throws ValidationException
     */
    public function handle(): int
    {
        $validator = Validator::make($this->options(), [
            'marketplace' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return 0;
        }

        $data = [
            'marketplace' => $this->option('marketplace'),
            'username' => $this->option('username'),
            'password' => $this->option('password')
        ];

        Integration::create($data);

        $this->info('The command was successful!');

        return 1;
    }
}
