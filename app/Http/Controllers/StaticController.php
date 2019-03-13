<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function terms()
    {
        $title = config('app.name').' - Terms & conditions';
        return view('static.terms', ['title' => $title]);
    }

    public function disclaimer()
    {
        $title = config('app.name').' - Disclaimer';
        return view('static.disclaimer', ['title' => $title]);
    }

    public function privacy()
    {
        $title = config('app.name').' - Privacy Policy';
        return view('static.privacy', ['title' => $title]);
    }

    public function faq()
    {
        $title = config('app.name').' - FAQ';
        return view('static.faq', ['title' => $title]);
    }

    public function aboutus()
    {
        $title = config('app.name').' - About Us';
        // OGP
        $ogp = [
            ['property' => 'og:title', 'content' => $title],
            ['property' => 'og:type', 'content' => 'article'],
            ['property' => 'og:url', 'content' => url()->current()],
            ['property' => 'og:image', 'content' => asset('/img/zenventures_logo_315x600.png')],
            ['property' => 'og:image:secure_url', 'content' => asset('/img/zenventures_logo_315x600.png')],
            ['property' => 'og:site_name', 'content' => config('app.name')],
            ['property' => 'og:description', 'content' => __(config('app.description'))],
            ['property' => 'fb:app_id', 'content' => config('app.fb_app_id')],
            ['name' => 'twitter:card', 'content' => 'summary'],
            ['name' => 'twitter:image', 'content' => asset('/img/zenventures_logo_512.png')],
        ];
        return view('static.aboutus', ['title' => $title, 'ogp' => $ogp]);
    }

}
