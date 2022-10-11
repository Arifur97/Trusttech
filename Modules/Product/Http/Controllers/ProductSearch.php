<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Attribute\Entities\Attribute;
use Modules\Brand\Entities\Brand;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Events\ShowingProductList;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

trait ProductSearch
{
    /**
     * Search products for the request.
     *
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function searchProducts(Product $model, ProductFilter $productFilter)
    {
        $productIds = [];

        if (request()->filled('query')) {
            // $model = $model->search(request('query'));
            // $productIds = $model->keys();
            
            return $this->customSearch($model, $productFilter);
        }

        $query = $model->filter($productFilter);

        if (request()->filled('category')) {
            $productIds = (clone $query)->select('products.id')->resetOrders()->pluck('id');
        }

        $products = $query->paginate(request('perPage', 30));

        event(new ShowingProductList($products));

        return response()->json([
            'products' => $products,
            'attributes' => $this->getAttributes(),
        ]);
    }

    public function customSearch(Product $model, ProductFilter $productFilter)
    {
        if (request()->filled('query')) {
            $model = $model->search(request('query'));
        }

        $query = $model->filter($productFilter);
        
        $products = $query->paginate(request('perPage', 30));

        $newProducts = [];
        $queryTxtArray = explode(" ", request('query'));

        for($i = 0; $i < sizeof($products); $i++) {
            $count = 0;
            for($j = 0; $j <sizeof($queryTxtArray); $j++) {
                $temp = str_contains(strtolower($products[$i]['name']), strtolower($queryTxtArray[$j]));
                if($temp) {
                    $count++;
                }
            }
            if($count >= sizeof($queryTxtArray)) {
                $newProducts[] = $products[$i];
                $count = 0;
            }
        }

        event(new ShowingProductList($products));

        return response()->json([
            'products' => $this->paginate($newProducts),
            'attributes' => $this->getAttributes(),
        ]);
    }
    
    public function searchPcbuilderProducts(Product $model, ProductFilter $productFilter)
    {
        if (request()->filled('query')) {
            $model = $model->search(request('query'));
        }

        $query = $model->filter($productFilter);
        
        $products = $query->paginate(request('perPage', 30));

        $newProducts = [];
        for($i = 0; $i < sizeof($products); $i++) {
            $temp = str_contains(strtolower($products[$i]['name']), strtolower(request('query')));
            if($temp) {
                $newProducts[] = $products[$i];
            }
        }

        event(new ShowingProductList($products));

        return response()->json([
            'products' => $this->paginate($newProducts),
            'attributes' => $this->getAttributes(),
        ]);
    }

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    private function getAttributes()
    {
        // there was an [OR] condition in this condition block : $this->filteringViaRootCategory()
        if (! request()->filled('category')) {
            return collect();
        }
        
        $categoryId = $this->getCategoryIdBySlug(request()->get('category'));

        return Attribute::with('values')
            ->where('is_filterable', true)
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })
            ->orderBy('attribute_order', 'asc')
            ->get();
    }

    private function filteringViaRootCategory()
    {
        return Category::where('slug', request('category'))
            ->firstOrNew([])
            ->isRoot();
    }

    private function getProductsCategoryIds($productIds)
    {
        return DB::table('product_categories')
            ->whereIn('product_id', $productIds)
            ->distinct()
            ->pluck('category_id');
    }

    private function getCategoryIdBySlug($slug)
    {
        return Category::findBySlug($slug)->id;
    }

    private function getCategoryByIds($ids)
    {
        $categories = Category::with('files')
            ->select(['id', 'parent_id', 'slug'])
            ->findorfail($ids);

        foreach($categories as $category) {
            if($category->parent_id == 12) continue;
            if($category->parent_id) {
                if(Category::where('parent_id', $category->id)->count() == 0) $data[] = $category;
            }
        }
            
        return $data ?? [];
    }

    public function getOfferProducts($categoryId = null) {
        $query = Product::where('offer_price_start', '<=', Carbon::now())
            ->where('offer_price_end', '>=', Carbon::now())
            ->forCard();
        
            
        $productIds = $query->pluck('id');
        $products = $query
            ->when($categoryId != null, function ($query) use ($categoryId) {
                return $query->join('product_categories', 'product_id', '=', 'id')
                    ->where('category_id', $categoryId);
            })
            ->get();
        
        return response()->json([
            "products" => [
                "data" => $products,
                "categories" => $this->getCategoryByIds($this->getProductsCategoryIds($productIds)),
                "active_category_id" => $categoryId,
            ],
        ]);
    }
}
