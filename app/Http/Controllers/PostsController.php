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
            ->latest('published_at')
            ->paginate();

        return view('posts.index', ['posts' => $posts]);
    }
}
