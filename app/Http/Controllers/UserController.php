<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as OClient;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $oClient = OClient::where('password_client', 1)->first();
            return $this->getTokenAndRefreshToken($oClient, request('email'), request('password'));
        }
        else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $password = $request->password;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $oClient = OClient::where('password_client', 1)->first();
        return $this->getTokenAndRefreshToken($oClient, $user->email, $password);
    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password) {
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        $params = [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ];
        $response = $http->request('POST', route('passport.token'), $params);

        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, $this->successStatus);
    }

    public function details() {
        $user = Auth::user();
        return response()->json($user, $this->successStatus);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function unauthorized() {
        return response()->json("unauthorized", 401);
    }
}