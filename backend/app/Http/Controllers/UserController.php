<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\File\FileService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as RESPONSE;

class UserController extends AbstractApiController
{
    private $userService;
    private $fileService;

    public function __construct(UserService $userService, FileService $fileService)
    {
        $this->middleware('auth:sanctum')->only(['index', 'update', 'findByUserName', 'searchUser']);
        $this->userService = $userService;
        $this->fileService = $fileService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = $request->user()->_id;
        $response = [
            'success' => true,
            'data' => $this->userService->list($userId)
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $response = [
            'success' => true,
            'data' => $this->userService->create($request->validated()),
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $response = [
            'success' => true,
            'data' => $this->userService->show($user->_id, ['tweets', 'followers.following', 'following.follower', 'likes']),
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     *  @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $fileName = null;
        if ($request->hasFile('avatar')) {
            $fileName = $this->fileService->upload($user, $request->file('avatar'));
        }
        $payload = $request->validated();
        if ($fileName) {
            $payload['avatar'] = $fileName;
        }
        $updatedUser = $this->userService->update($payload, $user);

        $response = [
            'success' => true,
            'data' => $updatedUser
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchUser(Request $request)
    {
        $searchTerm = $request->input('q');
        $response = [
            'success' => true,
            'data' => $this->userService->searchUser($searchTerm),
        ];

        return $this->apiSuccessResponse($response, RESPONSE::HTTP_CREATED);
    }
}
