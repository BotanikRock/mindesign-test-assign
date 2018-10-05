<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
