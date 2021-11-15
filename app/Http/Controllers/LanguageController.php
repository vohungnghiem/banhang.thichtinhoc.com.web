<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        // App::setLocale($lang);
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('locale', $lang);
        }
        App::setLocale(Session()->get('locale'));
        return Redirect::back();
    }
}
