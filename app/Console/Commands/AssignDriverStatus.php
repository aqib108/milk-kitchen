<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\AssignDriverOrder;
use App\Models\WeekDay;

class AssignDriverStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign_driver_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Driver assign status specific day';

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
        $current = Carbon::now();
        $currentdatetime = $current->toDateTimeString();
        $today = strtotime($currentdatetime);
        $driverStatus = AssignDriverOrder::orderBy('created_at','DESC')->get();
        foreach($driverStatus as $driver){
            $driverID = AssignDriverOrder::find($driver->id);
            $drivertime = strtotime($driver->created_at);
            echo $days = round(( $today - $drivertime ) /86400);
            if($days > 0)
            {
                $data = [
                    'is_assign' => 0,
                ];
                $driverID->update($data);
            }
        }
    }
}