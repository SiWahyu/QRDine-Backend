<?php

namespace App\Http\Controllers\Api\Admin;

use App\DTOs\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private UserService $userService) {}

    public function index()
    {
        return response()->json([
            'data' => UserResource::collection($this->userService->getAll())
        ]);
    }

    public function  store(StoreUserRequest $request)
    {

        $data = UserData::fromRequest($request);

        $user = $this->userService->store($data);

        return response()->json([
            'message' => 'User created successfully',
            'data' => UserResource::make($user)
        ]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {

        $data = UserData::fromRequest($request);

        $this->userService->update($user, $data);

        return response()->json([
            'message' => 'User updated successfully',
        ]);
    }

    public function destroy(User $user)
    {
        $this->userService->delete($user);
        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}
