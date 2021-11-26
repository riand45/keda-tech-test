<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use App\Repositories\ConversationRepositoryInterface;

class MessageController extends Controller
{
    private $conversationRepository;

    public function __construct(ConversationRepositoryInterface $conversationRepository)
    {
       $this->conversationRepository = $conversationRepository;
    }

    public function createMessage(MessageStoreRequest $request)
    {
        return $this->conversationRepository->store($request->receiver_id,$request->content);
    }
}
