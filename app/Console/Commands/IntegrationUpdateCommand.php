<?php

namespace App\Console\Commands;

use App\Models\Integration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class IntegrationUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:integration {--id=} {--marketplace= } {--username= } {--password= }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command update integration.';

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
        $marketplace = $this->option('marketplace');
        $username = $this->option('username');
        $password = $this->option('password');
        $data = [];
        if (!empty($marketplace) && !is_null($marketplace))
        {
            $data['marketplace'] = $marketplace;
        }
        if (!empty($username) && !is_null($username))
        {
            $data['username'] = $username;
        }
        if (!empty($password) && !is_null($password))
        {
            $data['password'] = $password;
        }

        Integration::query()
            ->where('id', $this->option('id'))
            ->update($data);

        $this->info('The command was successful!');

        return 1;
    }
}
