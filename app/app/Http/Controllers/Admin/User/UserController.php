<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email:rfc,dns|unique:users,email|max:255',
                'password' => 'required|min:5|max:25',
            ]);

            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ]);

            $user->password = Hash::make($request->input('password'));
            $user->save();

            auth('api')->login($user, true);
            $user->token = $user->createToken($user->email)->accessToken;

            return response()->json([
                'record' => $user,
                'message' => 'User registered succesful',
            ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An error has occurred, try again later',
            ], 400);
        }
    }

    public function getUser()
    {
        return response()->json([
            'record' => auth()->user()
        ]);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->input('email'))
                ->whereNull('deleted_at')
                ->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'message' => 'E-mail or password are incorrect',
                ], 422);
            }

            auth('api')->login($user, true);
            $user->token = $user->createToken($user->email)->accessToken;

            return response()->json([
                'record' => $user
            ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An error has occurred, try again later',
            ], 400);
        }
    }

    public function verifyEmail($userId)
    {
        try {
            $user = User::where('id', $userId)
                ->whereNull('deleted_at')
                ->firstOrFail();

            if ($user->email_verified_at) {
                return response()->json([
                    'message' => 'The email has already been verified'
                ], 400);
            }

            $user->email_verified_at = Carbon::now();
            $user->save();

            return response()->json([
                'message' => 'User verified successful',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An error has occurred, try again later',
            ], 400);
        }
    }
}
