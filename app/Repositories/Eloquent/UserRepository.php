<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Helpers\APIResponse;
use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

    /**
    * @param array $request
    * @return JsonResponse
    */
    public function login($request): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return APIResponse::success([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }

    /**
    * @return JsonResponse
    */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return APIResponse::success([
            'message' => 'Logout Successfully',
        ]);
    }

    /**
    * @param int $type
    * @param bool $withSoftDeletes
    * @return JsonResponse
    */
    public function allCustomer($type = User::CUSTOMER, bool $withSoftDeletes = false)
    {
        $query = User::query();

        if($withSoftDeletes){
            $query->withTrashed();
        }

        $data = User::where('user_type_id', $type)->get();

        return APIResponse::success($data);
    }

    /**
    * @param int $id
    * @return JsonResponse
    */
    public function deleteCustumer($id)
    {
        $user = User::findOrFail($id);

        if($user->user_type_id != User::CUSTOMER){
            throw ValidationException::withMessages(['user' => ['user is not customer']]);
        }

        $user->delete();

        return APIResponse::success('custumer has been deleted');
    }
}