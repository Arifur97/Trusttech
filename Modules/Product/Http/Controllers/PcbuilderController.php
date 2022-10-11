<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\PcBuilder;
use Modules\Product\Entities\PcBuilderComponent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PcbuilderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(SetProductSortOption::class)->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pcbuilder = Category::findBySlug('pc-builder');
        $categories = Category::findByIdForTree($pcbuilder->id);
        return view('public.pcbuilder.index', [
            "categories" => $categories,
        ]);
    }

    public function store(Request $request) {
        $pcbuilder = new PcBuilder();
        $pcbuilder->user_id = Auth::id();
        $pcbuilder->total_item = $request->total_item;
        $pcbuilder->total_price = $request->total_price;
        if($request->pcb_is_qoute) {
            $pcbuilder->flag = 'quotation';
        }
        $pcbuilder->save();

        $components = [];
        for($i = 0; $i < sizeof($request->component_product_ids); $i++) {
            if($request->component_product_ids[$i]) {
                $components[$i]['pc_builder_id'] = $pcbuilder->id;
                $components[$i]['product_id'] = $request->component_product_ids[$i];
                $components[$i]['category_id'] = $request->component_category_ids[$i];
            }
        }

        DB::table('pc_builder_components')->insert($components);
        
        $success = "Success!";
        return redirect()->route('account.pcbuilder.index')->withSuccess($success);
    }

    public function show(Request $request) {
        $pcbuilder = Category::findBySlug('pc-builder');
        $categories = Category::findByIdForTree($pcbuilder->id);
        return view('public.pcbuilder.show', [
            "categories" => $categories,
        ]);
    }

    public function print(Request $request) {
        $pcbuilder = Category::findBySlug('pc-builder');
        $categories = Category::findByIdForTree($pcbuilder->id);
        return view('public.pcbuilder.print', [
            "categories" => $categories,
        ]);
    }

}
