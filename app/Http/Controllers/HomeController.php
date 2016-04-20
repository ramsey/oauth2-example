<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Instagram;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $instagramUser = null;
        $instagramFeed = null;

        if ($request->session()->has('instagramToken')) {
            $instagramToken = $request->session()->get('instagramToken');

            $instagramUser = Instagram::getResourceOwner($instagramToken);

            $feedRequest = Instagram::getAuthenticatedRequest(
                'GET',
                'https://api.instagram.com/v1/users/self/feed',
                $instagramToken
            );

            $client = new \GuzzleHttp\Client();
            $feedResponse = $client->send($feedRequest);
            $instagramFeed = json_decode($feedResponse->getBody()->getContents());
        }

        $redirectionHandler = function ($url, $provider) use ($request) {
            $request->session()->put(
                'instagramState',
                $provider->getState()
            );

            return $url;
        };

        $authUrl = Instagram::authorize([], $redirectionHandler);

        return view('home', [
            'instagramAuthUrl' => $authUrl,
            'instagramUser' => $instagramUser,
            'instagramFeed' => $instagramFeed,
        ]);
    }

    public function instagram(Request $request)
    {
        if ($request->session()->has('instagramToken')) {
            return redirect()->action('HomeController@index');
        }

        if (!$request->has('state')
            || $request->state !== $request->session()->get('instagramState')
        ) {
            abort(400, 'Invalid state');
        }

        if (!$request->has('code')) {
            abort(400, 'Authorization code not available');
        }

        $token = Instagram::getAccessToken('authorization_code', [
            'code' => $request->code,
        ]);

        $request->session()->put('instagramToken', $token);

        return redirect()->action('HomeController@index');
    }

    public function forgetInstagram(Request $request)
    {
        $request->session()->forget('instagramToken');

        return redirect()->action('HomeController@index');
    }
}
