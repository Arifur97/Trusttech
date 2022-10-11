<?php

namespace Modules\Product\Admin;

use Modules\Admin\Ui\AdminTable;
use Modules\Product\Entities\PcBuilder;
use Modules\Product\Entities\PcBuilderComponent;

class PcBuilderTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->editColumn('User Name', function ($pcbuilder) {
                return '$pcbuilder->user->name';
            });
    }
}
