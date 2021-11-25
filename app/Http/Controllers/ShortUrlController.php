<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
   private $shortUrl;

    public function __construct(ShortUrl $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShortUrl $shortUrl)
    {
        $data = [
            'shotUrls' => $shortUrl->orderBy('hits', 'desc')->paginate(100),
            'slot' => ''
        ];
        return view('short-url.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Short URL',
            'action' => route('short-urls.store'),
            'buttonTitle' => 'Create',
            'method' => 'POST',
        ];
        return view('short-url.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ShortUrl $shortUrl)
    {
        $newShortUrl = $shortUrl->createShortUrl($request->all());

        return redirect(route('short-urls.index'))->with('status', 'Short URL ' . route('s.show', ['code' => $newShortUrl]));
    }

    /**
     * Display the specified resource.
     *
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $shortUrlId = ShortUrl::decode($code);

        $shortUrl = ShortUrl::find($shortUrlId);

        if (empty($shortUrl)) {
            abort(404);
        }

        $shortUrl->increment('hits');
        return redirect($shortUrl->url);
    }

    public function edit(ShortUrl $shortUrl)
    {
        $data = [
            'title' => 'Edit Short URL',
            'buttonTitle' => 'Update',
            'shortUrl' => $shortUrl,
            'action' => route('short-urls.update', ['short_url' => $shortUrl->id]),
            'method' => 'PUT',
         ];

        return view('short-url.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShortUrl  $shortUrl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortUrl $shortUrl)
    {
        $data = $request->all();
        $shortUrl->validator($data)->validate();

        $shortUrl->fill($data);
        $shortUrl->save();

        return redirect(route('short-urls.index'))->with('status', 'Short URL updated successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShortUrl  $shortUrl
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortUrl $shortUrl)
    {
        $shortUrl->delete();

        return back()->with('status', 'Short URL deleted successfull');
    }
}
