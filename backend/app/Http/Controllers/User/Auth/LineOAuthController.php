<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\Http\Controllers\User\Auth\RegisteredUserController;

class LineOAuthController extends Controller
{
    private const LINE_OAUTH_URI = 'https://access.line.me/oauth2/v2.1/authorize?';
    private const LINE_TOKEN_API_URI = 'https://api.line.me/oauth2/v2.1/';
    private const LINE_PROFILE_API_URI = 'https://api.line.me/v2/';
    private $client_id;
    private $client_secret;
    private $callback_url;

    public function __construct() {
        $this->client_id = config('line.client_id');
        $this->client_secret = config('line.client_secret');
        $this->callback_url = config('line.callback_url');
    }

    public function redirectToProvider()
    {
         // state生成
         $state = Str::random(40);
         \Cookie::queue('state', $state,100);
 
         // nonce生成
         $nonce  = Str::random(40);
         \Cookie::queue('nonce', $nonce,100);

        $query_data = [
            'response_type' => 'code',
            'client_id' => $this->client_id,
            'redirect_uri' => $this->callback_url,
            'state' => $state,
            'scope' => 'scope=profile openid email',
            'nonce' => $nonce,
        ];
        $query_str = http_build_query($query_data, '', '&');
        return redirect(self::LINE_OAUTH_URI . $query_str);
    }

    public function handleProviderCallback(Request $request)
    {
        $code = $request->query('code');
        dd($request->query());
        $token_info = $this->fetchTokenInfo($code);
        $user_info = $this->fetchUserInfo($token_info->access_token);
        //  ログイン処理
        dd($user_info);
    }

    private function fetchUserInfo($access_token)
    {
        $base_uri = ['base_uri' => self::LINE_PROFILE_API_URI];
        $method = 'GET';
        $path = 'profile';
        $headers = ['headers' => 
            [
                'Authorization' => 'Bearer ' . $access_token
            ]
        ];
        $user_info = $this->sendRequest($base_uri, $method, $path, $headers);
        dd($user_info);
        return $user_info;
    }

    private function fetchTokenInfo($code)
    {
        $base_uri = ['base_uri' => self::LINE_TOKEN_API_URI];
        $method = 'POST';
        $path = 'token';
        $headers = ['headers' => 
            [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ];
        $form_params = ['form_params' => 
            [
                'code'          => $code,
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_uri'  => $this->callback_url,
                'grant_type'    => 'authorization_code'
            ]
        ];
        $token_info = $this->sendRequest($base_uri, $method, $path, $headers, $form_params);
        return $token_info;
    }

    private function sendRequest($base_uri, $method, $path, $headers, $form_params = null)
    {
        try {
            $client = new Client($base_uri);
            if ($form_params) {
                $response = $client->request($method, $path, $form_params, $headers);
            } else {
                $response = $client->request($method, $path, $headers);
            }
        } catch(\Exception $ex) {
            //例外処理
        }
        $result_json = $response->getbody()->getcontents();
        $result = json_decode($result_json);
        return $result;
    }
}