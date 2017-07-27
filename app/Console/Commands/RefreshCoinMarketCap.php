<?php

namespace App\Console\Commands;

use App\Classes\CoinDataService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RefreshCoinMarketCap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:refresh-cmc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refetches data from CoinMarketCap';

    protected $coinDataService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CoinDataService $coinDataService)
    {
        parent::__construct();

        $this->coinDataService = $coinDataService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->coinDataService->createProvider('CoinMarketCap')->getData(true)) {
            if (env('APP_ENV') == 'local') {
                $this->info(Carbon::now() . ' - Success.');
            }
        } else {
            $this->error(Carbon::now() . ' - There was a problem with refreshing CoinMarketCap data.');
        };
    }
}
