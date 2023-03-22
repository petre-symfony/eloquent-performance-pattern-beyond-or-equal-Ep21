<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Device;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StoresController extends Controller {
    /**
     * Display the user's profile form.
     */
    public function index(): View {
        /** Ep25, 26, 27
        $myLocation = [-79.47, 43.14];

        $stores = Store::
            //selectDistanceTo($myLocation) Ep25
            //->withinDistanceTo($myLocation, 10000) Ep26
            //->orderByDistanceTo($myLocation) Ep27
            ->paginate();

        return view('stores.index', ['stores' => $stores]);
         */
    }
}
