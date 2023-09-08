<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class TicketApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
    public function handle()
    {
        $responseTicket = Http::withOptions([
            'proxy' => '10.200.101.18:8080'
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ])->get('https://cms-api.pacific-league.jp/api/game_schedule/?team=1992001&year=2023');

        $tickets = json_decode($responseTicket->body(), true);
        if(isset($tickets['status']) && $tickets['status'] == false) {
          $tickets = [];
        } else {
          Redis::set('tickets', json_encode($tickets));      
        }
        $this->info('Get tickets success!');
        return 0;
    }
}
