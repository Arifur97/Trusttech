<?php

namespace Modules\Product\Http\Response;

use Illuminate\Support\Collection;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Illuminate\Contracts\Support\Responsable;

class SuggestionsResponse implements Responsable
{
    private $query;
    private $products;
    private $productsViaId;
    private $productsViaAlpha;
    private $categories;
    private $totalResults;

    /**
     * Create a new instance.
     *
     * @param string $query
     * @param int $totalResults
     * @param \Illuminate\Support\Collection $products
     * @param \Illuminate\Support\Collection $categories
     */
    public function __construct($query, Collection $products, Collection $productsViaId, Collection $productsViaAlpha, $totalResults)
    {
        $this->query = $query;
        $this->products = $products;
        $this->productsViaId = $productsViaId;
        $this->productsViaAlpha = $productsViaAlpha;
        $this->totalResults = $totalResults;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json([
            'products' => $this->transformProducts(),
            'remaining' => $this->getRemainingCount(),
        ]);
    }

    /**
     * Transform the categories.
     *
     * @return \Illuminate\Support\Collection
     */
    private function transformCategories()
    {
        return $this->categories->map(function (Category $category) {
            return [
                'slug' => $category->slug,
                'name' => $category->name,
                'url' => $category->url(),
            ];
        })->unique('slug')->values();
    }

    /**
     * Transform the products.
     *
     * @return \Illuminate\Support\Collection
     */
    private function transformProducts()
    {
        $tempMerge = $this->productsViaAlpha->merge($this->productsViaId);
        $data = $tempMerge->merge($this->products);
        return $data->map(function (?Product $product) {
            if($product != null) {
                return [
                    'slug' => $product->slug,
                    'name' => $product->name, // highligh off for product name search --commit[0c2c9fa]
                    'formatted_price' => $product->getFormattedPriceAttribute(),
                    'base_image' => $product->getBaseImageAttribute(),
                    'category_image' => $product->getCategoryImageAttribute(),
                    'is_out_of_stock' => $product->isOutOfStock(),
                    'in_stock' => $product->in_stock,
                    'url' => $product->url(),
                ];
            }
        })->unique('slug')->values()->filter();
    }

    /**
     * Highlight the given text.
     *
     * @param string $text
     * @return string
     */
    private function highlight($text)
    {
        $query = str_replace(' ', '|', preg_quote($this->query));

        return preg_replace("/($query)/i", '<em>$1</em>', $text);
    }

    /**
     * Get remaining results count.
     *
     * @return int
     */
    private function getRemainingCount()
    {
        return $this->totalResults = $this->productsViaAlpha->merge($this->productsViaId)->count();
    }
}
