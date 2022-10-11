<?php

namespace Modules\Product\Entities;

use Modules\Support\Eloquent\Model;
use Illuminate\Http\Request;

use Modules\Product\Entities\PcBuilderComponent;
use Modules\User\Entities\User;
use Modules\Product\Admin\PcBuilderTable;

class PcBuilder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pc_builders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'total_item',
        'totol_price',
        'flag',
        'is_active',
        'status',
        'note',
    ];


    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function component() {
        return $this->hasMany(PcBuilderComponent::class)->with(['category', 'product']);
    }

    /**
     * Get table data for the resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function table(Request $request)
    {
        $query = $this->where('flag', '=', 'quotation')
            ->with('user')
            ->latest()
            ->get();
        
        return new PcBuilderTable($query);
    }
}
