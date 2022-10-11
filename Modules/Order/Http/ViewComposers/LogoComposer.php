<?php

namespace Modules\Order\Http\ViewComposers;

use Modules\Media\Entities\File;
use Illuminate\Support\Facades\Cache;

class LogoComposer
{

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'logo' => $this->getHeaderLogo(),
        ]);
    }

    private function getHeaderLogo()
    {
        return $this->getMedia(setting('storefront_header_logo'))->path;
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }
}
