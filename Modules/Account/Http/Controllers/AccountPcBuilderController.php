<?php

namespace Modules\Account\Http\Controllers;

use Modules\Product\Entities\PcBuilder;
use Illuminate\Support\Facades\Auth;

class AccountPcBuilderController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pcbuilder = PcBuilder::where('user_id', '=', Auth::id())->latest()->paginate(10);
        
        return view('public.account.pcbuilder.index', compact('pcbuilder'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pcbuilder = PcBuilder::where('id', '=', $id)
            ->with('component')
            ->first();
        
        return view('public.account.pcbuilder.show', compact('pcbuilder'));
    }

    public function flagChange($id) {
        $pcbuilder = PcBuilder::findorfail($id);
        $pcbuilder->flag = 'quotation';
        $pcbuilder->update();
        $success = "Successfully sent a quotation.";
        return redirect()->back()->withSuccess($success);
    }
}

