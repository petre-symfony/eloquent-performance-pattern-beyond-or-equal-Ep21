<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;
use App\Models\Device;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CustomersController extends Controller {
    /**
     * Display the user's profile form.
     */
    public function index(): View {
        $customers = Customer::inRandomOrder()->take(1)->get();

        $regions = Region::hasCustomer($customers->first())->get();

        return view('customers.index', [
            'customers' => $customers,
            'regions' => $regions
        ]);
    }
}
