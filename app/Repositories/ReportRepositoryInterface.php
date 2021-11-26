<?php
namespace App\Repositories;

use Illuminate\Http\JsonResponse;

interface ReportRepositoryInterface
{
    /**
     * @param array $request
     * @return JsonResponse
     */
    public function store(array $request);
}