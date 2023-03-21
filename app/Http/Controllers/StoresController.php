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
        $myLocation = [-79.47, 43.14];

        $stores = Store::
            selectDistanceTo($myLocation)
            ->paginate();

        return view('stores.index', ['stores' => $stores]);
    }
}
