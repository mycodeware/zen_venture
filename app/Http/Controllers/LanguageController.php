<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switchLang(Request $request, $lang)
    {
        if (array_key_exists($lang, config('languages'))) {
            session()->put('locale', $lang);
        }
        return Redirect::back();
    }
}
