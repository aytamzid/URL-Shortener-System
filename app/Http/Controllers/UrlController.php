<?php

namespace App\Http\Controllers;

use App\Models\URL;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{

    public function index()
    {

            $data['urls'] = URL::where('user_id', auth()->id())->latest()->get();

        return view('dashboard', $data)->with('success', 'URL created successfully');
    }

    public function create()
    {
        return view('components.home');
    }

    public function store(Request $request)
    {
        validator($request->all(), [
            'url' => 'required|url'
        ])->validate();

        try {
            function generateAndCheck()
            {
                $shorten_url = Str::random(rand(6, 8));
                $checkUrl = URL::where('shorten_url', $shorten_url)->first();
                if ($checkUrl) {
                    return generateAndCheck();
                } else {
                    return $shorten_url;
                }
            }


            $url = new URL();
            $url->user_id = auth()->id();
            $url->long_url = $request->url;
            $url->shorten_url = generateAndCheck();
            $url->save();

            return redirect()->route('dashboard')->with('success', 'URL created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');

        }
    }

    public function destroy($id)
    {
        $url = URL::findOrFail($id);
        $url->delete();
        return redirect()->route('dashboard')->with('success', 'URL deleted successfully');
    }

    public function show($shorten_url)
    {
        $url = URL::where('shorten_url', $shorten_url)->first();
        if ($url) {
            $url->increment('total_clicked');
            return redirect()->away($url->long_url);
        } else {
            return redirect()->route('dashboard');
        }
    }


}
