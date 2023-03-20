<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Device;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostsController extends Controller {
    /**
     * Display the user's profile form.
     */
    public function index(): View {
        $posts = Post::with('author')
            ->when(request('search'), function ($query, $search) {
                if (config('database.default') === 'mysql') {
                    $query
                        ->selectRaw('*, match(title, body) against(? in boolean mode) as score', [$search])
                        ->whereRaw('match(title, body) against(? in boolean mode)', [$search]);
                }

                if (config('database.default') === 'sqlite') {
                    throw new \Exception('This lesson does not support SQLite.');
                }

                if (config('database.default') === 'pgsql') {
                    $search = implode(' | ', array_filter(explode(' ', $search)));
                    $query
                        ->selectRaw("*, ts_rank(searchable, to_tsquery('english', ?)) as score", [$search])
                        ->whereRaw("searchable @@ to_tsquery('english', ?)", [$search]);
                }
            })
            ->paginate();

        return view('posts.index', ['posts' => $posts]);
    }
}
