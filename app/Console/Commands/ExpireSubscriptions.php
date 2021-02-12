<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire ended subscriptions';

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
        $expired = Subscription::where('expires_at', '<=', Carbon::now())->get();
        foreach($expired as $sub){
            try {
                $sub->user->removeRoles();
            } catch (\Throwable $th) {
                // errors
            }
            $sub->delete();
        }
    }
}
