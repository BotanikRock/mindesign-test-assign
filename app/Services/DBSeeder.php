<?php

namespace App\Services;

use App\Product;
use App\Category;
use App\Offer;

class DBSeeder
{
    /**
     * Insert/Update and entries
     * If entries are obsolete, then remove them
     *
     * @data  array
     * @return boolean
     */
    public static function fillWith($data){   
        $newProductsID = array_map(function($product) {
            return $product['id'];
        }, $data);

        $entriesID = Product::all()
                    ->map(function ($product) {
                        print_r($product);
                        return $product->id;
                    })->toArray();

        $productsForRemoving = array_diff($newProductsID, $entriesID);

        if (count($productsForRemoving) !== 0) {
            Product::destroy($productsForRemoving);
        }

        foreach($data as $product) {
            $offers = $product['offers'];
            $categories = $product['categories'];

            unset($product['offers'], $product['categories'], $product['last_supplied'], $product['category_google'], $product['images']);

            $productModel = Product::updateOrCreate(['id' => $product['id']], $product);

            $categoriesID = array_map(function($category) {
                return $category['id'];
            }, $categories);

            self::_updateAll($categories, Category::class, ['acrm_id']);
            $productModel->belongsToMany('App\Category', 'product_category')->sync($categoriesID);

            self::_updateAll($offers, Offer::class, [], ['product_id' => $product['id']]);
        }
    }  

    /**
     * updateOrCreate array of rows
     * 
     * @arr  array
     * @className string
     * @return boolean
     */
    private static function _updateAll($arr, $className, $fieldsToRemove, $addFields = []) {
        foreach($arr as $item) {
            foreach($fieldsToRemove as $key) {
                unset($item[$key]);
            }

            $className::updateOrCreate(
                ['id' => $item['id']],
                array_merge($item, $addFields)
            );
        }
    }
}
