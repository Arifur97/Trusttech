<?php

namespace Modules\Slider\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BannerController
{
    // two col
    public function indexTwoCol()
    {
        $banners = DB::table('banner_two_col')->orderBy('id', 'desc')->get();
        $bannersEnable = DB::table('banner_settings')->where('id', '=', '1')->first();
        return view('slider::admin.banner.two.index', compact('banners', 'bannersEnable'));
    }

    public function storeTwoCol(Request $request)
    {
        $file = $request->file('image');
        $path = Storage::putFile('banners', $file);

        DB::table('banner_two_col')->insert([
            'image' => 'storage/'.$path,
            'url' => $request->url
        ]);

        return redirect()->back()->withSuccess('Banner Stored Successfully');
    }

    public function updateTwoCol(Request $request, $id)
    {
        if( $request->file('image')) {
            $file = $request->file('image');
            $path = Storage::putFile('banners', $file);

            DB::table('banner_two_col')
            ->where('id', '=', $id)
            ->update([
                'image' => 'storage/'.$path,
            ]);
        } 
        if($request->url) {
            DB::table('banner_two_col')
            ->where('id', '=', $id)
            ->update([
                'url' => $request->url
            ]);
        }
        return redirect()->back()->withSuccess('Banner Updated Successfully');
    }

    public function destroyTwoCol($id) {
        DB::table('banner_two_col')
            ->where('id', '=', $id)
            ->delete();

        return redirect()->back()->withSuccess('Banner Deleted Successfully');
    }

    public function twoColEnable($id) {
        DB::table('banner_settings')
            ->where('id', '=', '1')
            ->update([
                'banner_two_col' => $id,
            ]);

        return redirect()->back()->withSuccess('Banner Enable Updated Successfully');
    }

    // three col
    public function indexThreeCol()
    {
        $banners = DB::table('banner_three_col')->orderBy('id', 'desc')->get();
        $bannersEnable = DB::table('banner_settings')->where('id', '=', '1')->first();
        return view('slider::admin.banner.three.index', compact('banners', 'bannersEnable'));
    }

    public function storeThreeCol(Request $request)
    {
        $file = $request->file('image');
        $path = Storage::putFile('banners', $file);

        DB::table('banner_three_col')->insert([
            'image' => 'storage/'.$path,
            'url' => $request->url
        ]);

        return redirect()->back()->withSuccess('Banner Stored Successfully');
    }

    public function updateThreeCol(Request $request, $id)
    {
        if( $request->file('image')) {
            $file = $request->file('image');
            $path = Storage::putFile('banners', $file);

            DB::table('banner_three_col')
            ->where('id', '=', $id)
            ->update([
                'image' => 'storage/'.$path,
            ]);
        } 
        if($request->url) {
            DB::table('banner_three_col')
            ->where('id', '=', $id)
            ->update([
                'url' => $request->url
            ]);
        }
        return redirect()->back()->withSuccess('Banner Updated Successfully');
    }

    public function destroyThreeCol($id) {
        DB::table('banner_three_col')
            ->where('id', '=', $id)
            ->delete();

        return redirect()->back()->withSuccess('Banner Deleted Successfully');
    }

    public function threeColEnable($id) {
        DB::table('banner_settings')
            ->where('id', '=', '1')
            ->update([
                'banner_three_col' => $id,
            ]);

        return redirect()->back()->withSuccess('Banner Enable Updated Successfully');
    }


    // four col
    public function indexFourCol()
    {
        $banners = DB::table('banner_four_col')->orderBy('id', 'desc')->get();
        $bannersEnable = DB::table('banner_settings')->where('id', '=', '1')->first();
        return view('slider::admin.banner.four.index', compact('banners', 'bannersEnable'));
    }

    public function storeFourCol(Request $request)
    {
        $file = $request->file('image');
        $path = Storage::putFile('banners', $file);

        DB::table('banner_four_col')->insert([
            'image' => 'storage/'.$path,
            'url' => $request->url
        ]);

        return redirect()->back()->withSuccess('Banner Stored Successfully');
    }

    public function updateFourCol(Request $request, $id)
    {
        if( $request->file('image')) {
            $file = $request->file('image');
            $path = Storage::putFile('banners', $file);

            DB::table('banner_four_col')
            ->where('id', '=', $id)
            ->update([
                'image' => 'storage/'.$path,
            ]);
        } 
        if($request->url) {
            DB::table('banner_four_col')
            ->where('id', '=', $id)
            ->update([
                'url' => $request->url
            ]);
        }
        return redirect()->back()->withSuccess('Banner Updated Successfully');
    }

    public function destroyFourCol($id) {
        DB::table('banner_four_col')
            ->where('id', '=', $id)
            ->delete();

        return redirect()->back()->withSuccess('Banner Deleted Successfully');
    }

    public function fourColEnable($id) {
        DB::table('banner_settings')
            ->where('id', '=', '1')
            ->update([
                'banner_four_col' => $id,
            ]);

        return redirect()->back()->withSuccess('Banner Enable Updated Successfully');
    }
}

