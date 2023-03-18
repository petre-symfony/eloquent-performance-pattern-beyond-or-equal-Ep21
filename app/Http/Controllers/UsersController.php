<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UsersController extends Controller {
    /**
     * Display the user's profile form.
     */
    public function index(): View {
        $users = User::
            whereBirtdayThisWeek()
            ->orderByBirthday()
            // ->orderByUpcomingBirthdays()
            ->orderBy('name')
            ->paginate();

        return view('users.index', [
            'users' => $users
        ]);
    }
}
