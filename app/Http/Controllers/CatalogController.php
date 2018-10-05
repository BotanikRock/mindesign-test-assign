<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;

use App\Category;
use App\Product;

class CatalogController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $categories = Category::getOnesWithoutParent();
        $products = Product::getMostPopular(Config::get('constants.mostPopularAmmount'));

        return view('catalog', [
            'pageTitle' => buildTitle('Главная'),
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function category(Request $request) {
        $category = Category::getBySlug($request->categorySlug);

        $categoriesToShow = $category->childrenCategories();
        $products = $category->products();

        return view('catalog', [
            'pageTitle' => buildTitle($category->title),
            'categories' => $categoriesToShow,
            'products' => $products
        ]);
    }

    public function product(Request $request) {
        $product = Product::findOrFail($request->productID);

        return view('product-page', [
            'pageTitle' => buildTitle($product->title),
            'product' => $product
        ]);
    }

    public function search(Request $request) {
        $searchStr = $request->query->get('search-str');

        $templateData = [ 'pageTitle' => buildTitle('Поиск по товарам') ];

        if(!$searchStr || strlen($searchStr) === 0) {
            $request->session()->flash('flash.formError', 'Заполните поле поиска');

            return view('catalog', $templateData);
        }

        $products = Product::searchByTitleAndDesc($searchStr);
        $templateData['products'] = $products;

        return view('catalog', $templateData);
    }
}
