<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $guarded = [];

    private function offersQuery() {
        return $this->hasMany('App\Offer');
    }

    public function offers() {
        return $this->offersQuery()->get();
    }
    
    public static function searchByTitleAndDesc($searchSubstr) {
        return self::where('title', 'like', "%$searchSubstr%")
            ->orWhere('description', 'like', "%$searchSubstr%")->get();
    }

    public static function getMostPopular($ammount) {
        $queryOffersWithSum = DB::table('offers')
            ->select('product_id', DB::raw('sum(sales) as sum_sales'))
            ->groupBy('product_id');

        return DB::table('products')
            ->joinSub($queryOffersWithSum, 'offers', function($join) {
                $join->on('products.id', '=', 'offers.product_id');
            })->orderByRaw('sum_sales DESC NULLS LAST')->limit($ammount)->get();
    }
}
