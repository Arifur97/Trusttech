<?php

namespace TrustTech\Http\Controllers;

use TrustTech\License;
use Illuminate\Routing\Controller;
use TrustTech\Http\Middleware\RedirectIfShouldNotCreateLicense;

class LicenseController extends Controller
{
    public function __construct()
    {
        $this->middleware(RedirectIfShouldNotCreateLicense::class);
    }

    public function create()
    {
        return view('license.create');
    }

    public function store(License $license)
    {
        request()->validate([
            'purchase_code' => 'required',
        ], [
            'required' => 'The purchase code field is required.',
        ]);

        $license->activate(request('purchase_code'));

        return redirect()->intended();
    }
}
