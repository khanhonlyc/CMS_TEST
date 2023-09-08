<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class NewApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:api';

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
        $responseNews = Http::withOptions([
            'proxy' => '10.200.101.18:8080'
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ])->get('http://cms-api.pacific-league.jp/api/news/?team=1992001');

        $news = json_decode($responseNews->body(), true);
        if(isset($news['status']) && $news['status'] == false) {
          $news = [];
        } else {
          $news = is_array($news) ? $news : [];
          usort($news ,function($first,$second){
            return strtolower($first['newsDate']) < strtolower($second['newsDate']);
          });

          $news = array_slice($news, 0, 5);
          Redis::set('news', json_encode($news)
          );      
        }
        $this->info('Get news success!');
        return 0;
    }
}
