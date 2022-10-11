<?php

namespace Modules\Admin\Http\ViewComposers;

use Modules\Order\Entities\Order;
use Modules\Core\Events\CollectingAssets;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Modules\Media\Entities\File;
use Illuminate\Support\Facades\Cache;

class AssetsComposer
{
    /**
     * The instance of AssetPipeline.
     *
     * @var \Modules\Core\Foundation\Asset\Pipeline\AssetPipeline
     */
    private $assetPipeline;

    /**
     * Create a new composer instance.
     *
     * @param \Modules\Core\Foundation\Asset\Pipeline\AssetPipeline $assetPipeline
     */
    public function __construct(AssetPipeline $assetPipeline)
    {
        $this->assetPipeline = $assetPipeline;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        event(new CollectingAssets($this->assetPipeline));

        $view->with([
            'assets' => $this->assetPipeline,
            'favicon' => $this->getFavicon(),
            'pending_orders' => $this->getPendingOrders(),
        ]);
    }

    private function getFavicon()
    {
        return $this->getMedia(setting('storefront_favicon'))->path;
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }

    private function getPendingOrders()
    {
        return Order::pendingOrders();
    }
}
