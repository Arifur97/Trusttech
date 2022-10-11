<?php

namespace Modules\Product\Http\Controllers;

use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Builder;
use Modules\Product\Http\Response\SuggestionsResponse;
use Illuminate\Support\Facades\DB;

class SuggestionController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $model)
    {
        $products = $this->getProducts($model);
        $productsViaId = $this->getProductsViaId();
        $productsViaAlpha = $this->getProductsViaAlpha($model);
        
        return new SuggestionsResponse(
            request('query'),
            $products,
            $productsViaId,
            $productsViaAlpha,
            $this->getTotalResults($model)
        );
    }

    /**
     * Get total results count.
     *
     * @param \Modules\Product\Entities\Product $model
     * @return int
     */
    private function getTotalResults(Product $model)
    {
        return $model->search(request('query'))
            ->query()
            ->count();
    }

    /**
     * Get products suggestions.
     *
     * @param \Modules\Product\Entities\Product $model
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getProducts(Product $model)
    {
        return $model->search(request('query'))
            ->query()
            ->limit(2)
            ->withName()
            ->withBaseImage()
            ->withCategoryImage()
            ->withPrice()
            ->addSelect([
                'products.id',
                'products.slug',
                'products.in_stock',
                'products.manage_stock',
                'products.qty',
            ])
            ->with(['files', 'categories' => function ($query) {
                $query->limit(5);
            }])
            ->when(request()->filled('category'), $this->categoryQuery())
            ->get();
    }

    private function getProductsViaId()
    {
        return Product::where('id', 'LIKE', request('query'))
            ->limit(1)
            ->withName()
            ->withBaseImage()
            ->withCategoryImage()
            ->withPrice()
            ->addSelect([
                'products.id',
                'products.slug',
                'products.in_stock',
                'products.manage_stock',
                'products.qty',
            ])
            ->with(['files', 'categories' => function ($query) {
                $query->limit(5);
            }])
            ->get();
    }

    private function getProductsViaAlpha(Product $model)
    {
        $query = request('query');
        $temp = DB::table($model->searchTable())
            ->where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->pluck($model->searchKey());

        $products = [];
        foreach($temp as $id) {
            $products[] = Product::where('id', '=', $id)
                ->limit(10)
                ->withName()
                ->withBaseImage()
                ->withCategoryImage()
                ->withPrice()
                ->addSelect([
                    'products.id',
                    'products.slug',
                    'products.in_stock',
                    'products.manage_stock',
                    'products.qty',
                ])
                ->with(['files', 'categories' => function ($query) {
                    $query->limit(5);
                }])
                ->first();
        }
        return collect($products);
    }

    /**
     * Returns categories condition closure.
     *
     * @return \Closure
     */
    private function categoryQuery()
    {
        return function (Builder $query) {
            $query->whereHas('categories', function ($categoryQuery) {
                $categoryQuery->where('slug', request('category'));
            });
        };
    }
}
