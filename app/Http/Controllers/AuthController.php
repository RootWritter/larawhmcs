<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DarthSoup\Whmcs\Facades\Whmcs;
use DarthSoup\Whmcs\WhmcsManager;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private WhmcsManager $whmcsManager;

    public function __construct(WhmcsManager $whmcsManager)
    {
        $this->whmcsManager = $whmcsManager;
    }
    public function login()
    {
        $data = [
            'site_name' => env('APP_NAME'),
            'page_name' => 'Sign In'
        ];
        return view('auth.login', $data);
    }
    public function doLogin(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);
            $dPost = array(
                'action' => 'ValidateLogin',
                // See https://developers.whmcs.com/api/authentication
                'username' => 'BGzl4sUDbEW1xE9vU2E6MNQFxvEy6hFL',
                'password' => '9Fn6ZT3c2Qx0fbuaHZZM80Qk65iv5nYs',
                'email' => 'dustwork.id@gmail.com',
                'password2' => '123456',
                'responsetype' => 'json',
            );
            $curl = post_curl("http://dev-whmcs.jagoanhosting.com/includes/api.php", $dPost);
            if ($curl['result'] == "success") {
                return back()->with('success', 'Success Login');
            } else {
                return back()->with('loginError', 'Invalid Combination email and password');
            }
        } catch (\Exception $e) {
            return back()->with('loginError',  $e->getMessage());
        }
    }
    public function register()
    {
        $data = [
            'site_name' => env('APP_NAME'),
            'page_name' => 'Sign Up'
        ];
        return view('auth.register', $data);
    }
    public function doRegister(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'phone_number' => 'required',
            ]);
            $this->whmcsManager->client()->addClient([
                'firstname' => $validate['first_name'],
                'lastname' => $validate['last_name'],
                'email' => $validate['email'],
                'address1' => $validate['address'],
                'city' => $validate['city'],
                'postcode' => '12345',
                'country' => 'ID',
                'state' => $validate['state'],
                'password2' => $validate['password'],
                'phonenumber' => $validate['phone_number'],
                'clientip' => $request->ip(),
            ]);
            return back()->with('success', 'Registration Success');
        } catch (\Exception $e) {
            return back()->with('registerError',  $e->getMessage());
        }
    }
}
