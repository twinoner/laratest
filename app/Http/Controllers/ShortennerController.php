<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;

class ShortennerController extends Controller
{
    public function index() 
    {
        $shortLinks = ShortLink::latest()->get();
        return view('shortenner.index', compact('shortLinks'));
    }
    
    public function add() 
    {
        return view('shortenner.form');
    }
    
    public function top() 
    {
        $shortLinks = ShortLink::orderBy('visits', 'DESC')->limit(100)->get();
        return view('shortenner.index', compact('shortLinks'));
    }

    public function shortit(Request $request) 
    {
        $request->validate([
            'link' => 'required|url'
        ]);
        $input['link'] = $request->link;
        $input['code'] = Str::random(6);

        $url = $request->link;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        curl_close($ch);

        $dom = new \DOMDocument();
        @$dom->loadHTML($data);
        
        $nodes = $dom->getElementsByTagName('title');
        $title = 'No title';
        if($nodes->length > 0){
            $title = $nodes->item(0)->nodeValue;
        }

        $input['title'] = $title;

        ShortLink::create($input);

        return redirect('shortenner')->with('success', 'Shorten Link Generated Successfully!');
    }

    public function shorted($code)
    {
        $find = ShortLink::where('code', $code)->first();
        
        $visit = $find->visits+1;
        ShortLink::where('code', $code)
        ->update(['visits' => $visit]);

        return redirect($find->link);
    }
}
