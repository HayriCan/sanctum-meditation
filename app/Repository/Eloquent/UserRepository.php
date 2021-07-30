<?php

namespace App\Repository\Eloquent;

use App\Exceptions\CustomException;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    use ApiResponser;

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @throws CustomException
     */
    public function storeUser(StoreUserRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $user = $this->model->create([
                'name' => $request->name,
                'password' => $request->password,
                'email' => $request->email,
            ]);

            DB::commit();
            return $this->success(['token'=> $this->createAuthToken($user),'user' => (new UserResource($user))],"User Created",JsonResponse::HTTP_CREATED);
        } catch(\Exception $e) {
            DB::rollBack();
            throw new CustomException(null,$e->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    public function createAuthToken($model)
    {
        return $model->createToken('API Token')->plainTextToken;
    }

    /**
     * @throws CustomException
     */
    public function loginUser(LoginUserRequest $request): JsonResponse
    {
        $user = User::where('email',$request->email)->first();
        if (is_null($user)){
            throw new CustomException(null,'User not found', JsonResponse::HTTP_BAD_REQUEST);
        }

        if (!auth()->attempt($request->only(['email','password']))) {
            throw new CustomException(null,'Credentials not match', JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->success(['token'=> $this->createAuthToken(Auth::user()),'user' => (new UserResource($user))],"User logged in",JsonResponse::HTTP_OK);
    }
}
