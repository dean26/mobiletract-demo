<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSearchRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Users
 */
class UserController extends Controller
{

    /**
     * Display a listing of the resource. Paginated.
     *
     * @authenticated
     *
     * @param  UserSearchRequest  $request
     * @return AnonymousResourceCollection
     */
    public function index(UserSearchRequest $request): AnonymousResourceCollection
    {
        return UserResource::collection((new UserService())->getAll($request->validated()));
    }

}
