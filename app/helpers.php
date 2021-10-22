<?php 
use Illuminate\Support\Facades\DB;
use App\Models\Product;
function days($proid)
{
    $product=Product::where('id',$proid)->get();
     dd($product);
}

?>