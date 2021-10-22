<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WeekDay;
class StandingOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        StandingOrder::query()
        ->each(function ($oldRecord) {
          $newRecord = $oldRecord->replicate();
          WeekDay::with(['WeekDay' => function($q){
            $q->deleteOld();
            }])->get();
          $newRecord->setTable('product_orders');
          $newRecord->save();
          $oldRecord->delete();
        });
        
    }
}
