<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class ClientImportApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clients:import {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command import the clients of apiFake';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $request =  Request::create("/api/auth/client/fakeStore/{$this->option('id')}", 'POST');
        $response = app()->handle($request);
        $this->info($response);
    }
}
