<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserServiceInterface $service)
    {
        $this->userService = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            return $this->userService->index(['roles']);
        }
        return response()->json(['message' => 'Access Denied'], Response::HTTP_FORBIDDEN);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $uname
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->userService->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->userService->update($id, $request->json()->all())) {
            return response()->json(['message' => 'Successfully Updated'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Fail Updated'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
