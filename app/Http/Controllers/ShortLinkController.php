<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLink = ShortLink::latest()->get();
        return view('frontend.home', compact('shortLink'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);
        $input['link'] = $request->link;
        $input['code'] = Str::random(6);
        $input['click_count'] = 0;
        ShortLink::create($input);

        return redirect('/')->withSuccess('Shorten Link Generated Successfully.');
    }
    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();
        if ($find) {
            $find->increment('click_count');
            return redirect($find->link);
        } else {
            return abort(404);
        }
    }
}
