<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserPurpose;
use App\Investor;
use App\Company;
use App\Entrepreneur;
use App\Freelancer;
use App\Post;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function getPosts()
    {
        $data = Post::select('text', 'published_at')
            ->where('published_at', '<=', date('Y-m-d H:i:s'))
            ->orderBy('published_at', 'desc')
            ->paginate(4);
        return $data;
    }
}
