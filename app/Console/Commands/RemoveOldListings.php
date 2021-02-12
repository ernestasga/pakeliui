<?php

namespace App\Console\Commands;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveOldListings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old listings';

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
        $expired = Listing::where('departure', '<', Carbon::now())->get();
        foreach ($expired as $listing) {
            try {
                $listing->delete();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}
