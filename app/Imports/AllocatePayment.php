<?php

namespace App\Imports;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class AllocatePayment implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $value) {
               if($key>0)
               {
                  DB::table('allocate_payments')->insert(['customerId' => $value[0],
                  'amount' =>$value[1],'start' =>$value[2],'end'=>$value[3],'created_at' =>now(),'updated_at'=>now()]);
               }
        }
    }
}
