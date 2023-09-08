<?php

namespace App\Console\Commands;

use App\Models\BatterModel;
use App\Models\PitcherModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UpdatePitBat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pitbat:getData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '投手とバッター両方で検索し...';

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
        $now = Carbon::now();
        $responsePits = Http::withOptions([
            'proxy' => '10.200.101.18:8080'
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ])->get('http://cms-api.pacific-league.jp/api/result_pitcher/?team=1992001&year=2023&kind=1&league=P');

        $pits = json_decode($responsePits->body(), true);
        if ($pits != null && is_array($pits) && !isset($pits['status'])) {
            foreach ($pits as $pit) {
                $arrData = [
                    "teamCode" => $pit['teamCode'],
                    "playerName" => $pit['playerName'],
                    "G" => $pit['G'],
                    "CG" => $pit['CG'],
                    "SHO" => $pit['SHO'],
                    "noWalks" => $pit['noWalks'],
                    "W" => $pit['W'],
                    "L" => $pit['L'],
                    "D" => $pit['D'],
                    "SV" => $pit['SV'],
                    "HLD" => $pit['HLD'],
                    "HLDP" => $pit['HLDP'],
                    "WPCT" => $pit['WPCT'],
                    "BF" => $pit['BF'],
                    "AB" => $pit['AB'],
                    "IP" => $pit['IP'],
                    "IP3" => $pit['IP3'],
                    "H" => $pit['H'],
                    "HR" => $pit['HR'],
                    "SH" => $pit['SH'],
                    "SF" => $pit['SF'],
                    "BB" => $pit['BB'],
                    "IBB" => $pit['IBB'],
                    "HP" => $pit['HP'],
                    "SO" => $pit['SO'],
                    "WP" => $pit['WP'],
                    "BK" => $pit['BK'],
                    "R" => $pit['R'],
                    "ER" => $pit['ER'],
                    "ERA" => $pit['ERA'],
                    "IF" => $pit['IF'],
                    "updated_at" => $now,

                ];
                PitcherModel::updateOrCreate(['playerCode' => $pit['playerCode']],$arrData);
            }
        }

        $responseBats = Http::withOptions([
            'proxy' => '10.200.101.18:8080'
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ])->get('http://cms-api.pacific-league.jp/api/result_batter/?team=1992001&year=2023&kind=1&league=P');

        $bats = json_decode($responseBats->body(), true);
        if ($bats != null && is_array($bats) && !isset($bats['status'])) {
            foreach ($bats as $bat) {
                $arrData = [
                    'teamCode' => $bat['teamCode'],
                    'playerName' => $bat['playerName'],
                    'G' => $bat['G'],
                    'PA' => $bat['PA'],
                    'AB' => $bat['AB'],
                    'R' => $bat['R'],
                    'H' => $bat['H'],
                    '2B' => $bat['2B'],
                    '3B' => $bat['3B'],
                    'HR' => $bat['HR'],
                    'TB' => $bat['TB'],
                    'RBI' => $bat['RBI'],
                    'SB' => $bat['SB'],
                    'CS' => $bat['CS'],
                    'SH' => $bat['SH'],
                    'SF' => $bat['SF'],
                    'BB' => $bat['BB'],
                    'IBB' => $bat['IBB'],
                    'HP' => $bat['HP'],
                    'SO' => $bat['SO'],
                    'GDP' => $bat['GDP'],
                    'LOB' => $bat['LOB'],
                    'AVG' => $bat['AVG'],
                    'SLG' => $bat['SLG'],
                    'OBP' => $bat['OBP'],
                    'IF' => $bat['IF'],
                    'updated_at' => $now,
                ];
                BatterModel::updateOrCreate(['playerCode' => $bat['playerCode']],$arrData);
            }
        }
        $this->info('Success!');
        return 0;
    }
}
