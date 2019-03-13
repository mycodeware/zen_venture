<?php

namespace App\Http\Controllers;

use App\Model\Photo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class siteMapController extends Controller
{
    public function sitemap(){
        $sitemap = App::make("sitemap");
        $now = Carbon::now();
        foreach (config('languages') as $lang => $language) {
            $sitemap->add(route('welcome', $lang), $now, '1.0', 'always');
            $sitemap->add(route('static.aboutus', $lang), Carbon::createFromTimestamp(Storage::disk('local_base')->lastModified('resources/views/static/aboutus.blade.php'))->format('Y-m-d H:i:s'), '0.8', 'monthly');
            $sitemap->add(route('static.terms', $lang), Carbon::createFromTimestamp(Storage::disk('local_base')->lastModified('resources/views/static/terms.blade.php'))->format('Y-m-d H:i:s'), '0.6', 'monthly');
            $sitemap->add(route('static.disclaimer', $lang), Carbon::createFromTimestamp(Storage::disk('local_base')->lastModified('resources/views/static/disclaimer.blade.php'))->format('Y-m-d H:i:s'), '0.6', 'monthly');
            $sitemap->add(route('static.privacy', $lang), Carbon::createFromTimestamp(Storage::disk('local_base')->lastModified('resources/views/static/privacy.blade.php'))->format('Y-m-d H:i:s'), '0.6', 'monthly');
            $sitemap->add(route('static.faq', $lang), Carbon::createFromTimestamp(Storage::disk('local_base')->lastModified('resources/views/static/faq.blade.php'))->format('Y-m-d H:i:s'), '0.6', 'monthly');
            $sitemap->add(route('inquiry.index', $lang), Carbon::createFromTimestamp(Storage::disk('local_base')->lastModified('resources/views/inquiry/index.blade.php'))->format('Y-m-d H:i:s'), '0.3', 'monthly');
        }

        return $sitemap->render('xml');
    }
}
