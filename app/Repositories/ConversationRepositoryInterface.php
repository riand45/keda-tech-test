<?php
namespace App\Repositories;

use Illuminate\Http\JsonResponse;

interface ConversationRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function showMyConversation();

    /**
     * @param int $receiver_id
     * @param string $content
     */
    public function store(int $receiver_id, string $content);

    /**
     * @return JsonResponse
     */
    public function showAllConversation();
}