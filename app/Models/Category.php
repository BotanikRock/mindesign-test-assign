<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    private function productsQuery() {
        return $this->belongsToMany('App\Product', 'product_category')->orderBy('title');
    }

    public function products() {
        return $this->productsQuery()->get();
    }

    private static function getBySlugQuery($parentSlug) {
        return self::where('alias', $parentSlug);
    }

    public static function getBySlug($parentSlug) {
        return self::getBySlugQuery($parentSlug)->first();
    }

    public static function getOnesWithoutParent() {
        return self::where('parent', null)->get();
    }

    public function childrenCategories() {
        return self::where('parent', $this->id)->get();
    }
}
