<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function shorten(Request $request)
    {
        $request->validate([ 'url' => 'required|url' ]);

        $url = Url::create([
            'original_url' => $request->url,
            'short_code' => Str::random(6),
        ]);

        return response()->json([ 'short_url' => url($url->short_code) ], 201);
    }

    public function redirect($shortCode)
    {
        $url = Url::where('short_code', $shortCode)->firstOrFail();
        return redirect($url->original_url);
    }
}