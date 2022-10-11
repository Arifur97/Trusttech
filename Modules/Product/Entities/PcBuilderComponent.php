<?php

namespace Modules\Product\Entities;

use Modules\Support\Eloquent\Model;

use Modules\Product\Entities\PcBuilder;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;

class PcBuilderComponent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pc_builder_components';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pc_builder_id',
        'category_id',
        'product_id',
        'is_active',
    ];


    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        
    }

    public function pcbuilder() {
        return $this->belongsTo(PcBuilder::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
