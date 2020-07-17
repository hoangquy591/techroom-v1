<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userRepository;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->userRepository = $repository;
    }

    /**
     * Register a UserResource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = $this->userRepository->store($data);
        if ($user) {
            $user->roles()->attach(2);
            return response()->json([
                'message' => 'Successfully Registered',
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Fail Registered',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {

        if (!$token = auth()->attempt($request->validated())) {
            return response()->json(['error' => 'Invalid Credentials'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated UserResource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ], Response::HTTP_OK);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()
        ]);
    }
}
