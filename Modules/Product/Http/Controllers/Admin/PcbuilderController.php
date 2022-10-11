<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Product\Entities\PcBuilder;
use Modules\Admin\Traits\HasCrudActions;


class PcbuilderController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = PcBuilder::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'product::pcbuilders.pcbuilder';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'product::admin.pcbuilder';


    public function show($id) {
        $pcbuilder = PcBuilder::where('id', '=', $id)
            ->with('component')
            ->first();

        return view('product::admin.pcbuilder.show', compact('pcbuilder'));
    }

    public function print($id) {
        $pcbuilder = PcBuilder::where('id', '=', $id)
            ->with('component')
            ->first();

        return view('product::admin.pcbuilder.print', compact('pcbuilder'));
    }

}
