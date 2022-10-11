<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Review\Entities\Review;
use Modules\Product\Entities\Product;
use Modules\Product\Events\ProductViewed;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Middleware\SetProductSortOption;
use Themes\Storefront\Banner;

class ProductController extends Controller
{
    use ProductSearch, ProductEmi;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(SetProductSortOption::class)->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function index(Product $model, ProductFilter $productFilter)
    {
        if (request()->expectsJson()) {
            if(request('pcbuilder')) {
                return $this->searchPcbuilderProducts($model, $productFilter);
            } else if(request('offer')) {
                return $this->getOfferProducts(request('offerCategoryId'));
            }else {
                return $this->searchProducts($model, $productFilter);
            }
        }
        return view('public.products.index');
    }

    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::findBySlug($slug);
        $relatedProducts = $product->relatedProducts()->forCard()->get();
        $upSellProducts = $product->upSellProducts()->forCard()->get();
        $review = $this->getReviewData($product);

        $productPrice = $product->getSellingPrice()->amount();
        $product_emi = $this->get_emi_data($productPrice);

        event(new ProductViewed($product));
        return view('public.products.show', compact('product', 'relatedProducts', 'upSellProducts', 'review', 'product_emi'));
    }

    public function showForQuickView($slug) {
        $product = Product::findBySlug($slug);
        return response()->json($product);
    }

    private function getReviewData(Product $product)
    {
        if (! setting('reviews_enabled')) {
            return;
        }

        return Review::countAndAvgRating($product);
    }

    public function offer() {
        $banner = Banner::getOfferPageBanner();
        return view('public.products.offer', [
            'offerPageBanner' => $banner->image->path,
        ]);
    }
}
