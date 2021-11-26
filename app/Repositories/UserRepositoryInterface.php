<?php
namespace App\Repositories;

use Illuminate\Http\JsonResponse;

interface UserRepositoryInterface
{
    /**
     * @param array $request
     * @return JsonResponse
     */
    public function login(array $request): JsonResponse;

    /**
     * @param array $request
     * @return JsonResponse
     */
    public function logout(): JsonResponse;

    /**
     * @param int $type
     * @param bool $withSoftDeletes
     * @return JsonResponse
     */
    public function allCustomer(int $type, bool $withSoftDeletes);

    /**
     * @param int $id
     */
    public function deleteCustumer(int $id);
}